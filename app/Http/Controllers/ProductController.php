<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Batch;
use App\Models\Brand;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        if (Gate::allows('owner-access')) {
            return Inertia::render('Products/Index', [
                'products' => Product::with(['category', 'unit'])->get()
            ]);
        }
        abort(403, 'Access to this resource is restricted');
    }

    public function create()
    {
        return Inertia::render('Products/Create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'product_id' => 'nullable',
                'alert_quantity' => 'required|integer',
                'category_id' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'unit_id' => 'required|exists:units,id',
            ]);

            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('storage/products'), $imageName);
            }

            if (isset($data['product_id'])) {
                $product = Product::find($data['product_id']);
                $product->name = $data['name'];
                $product->alert_quantity = $data['alert_quantity'];
                $product->unit_id = $data['unit_id'];
                $product->category_id = $data['category_id'];
                if ($imageName) {
                    $product->image = $imageName;
                }
                $product->save();

                return back()->with('success', 'Product updated successfully');
            }

            $product = new Product();
            $product->name = $data['name'];
            $product->alert_quantity = $data['alert_quantity'];
            $product->unit_id = $data['unit_id'];
            $product->category_id = $data['category_id'];
            if ($imageName) {
                $product->image = $imageName;
            }
            $product->save();

            return redirect()->route('products.index')->with('success', 'Product saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function select($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
            ], 404);
        }
    }

    public function show($id)
    {
        $batches = Batch::where('product_id', $id)->get();
        $purchase_ids = $batches->pluck('purchase_id');
        $invoices = Invoice::whereIn('purchase_id', $purchase_ids)->get();

        return Inertia::render('Products/Show', [
            'product' => Product::find($id),
            'batches' => $batches,
            'invoices' => $invoices,
        ]);
    }

    public function edit(Product $product)
    {
        return Inertia::render('Products/Create', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'units' => Unit::all()
        ]);
    }

    public function list(Request $request)
    {
        $query = Product::with(['category', 'unit']);

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        return response()->json($query->get());
    }

    public function eoqReport()
    {
        $emptyRequest = new Request();
        $results = $this->buildEOQReportDataSet($emptyRequest);
        
        return Inertia::render('Reports/Products/EOQ', [
            'results' => $results
        ]);
    }

    public function generate(Request $request)
    {
        $results = $this->buildEOQReportDataSet($request);
        
        return Inertia::render('Reports/Products/Results', [
            'results' => $results
        ]);
    }

    public function buildEOQReportDataSet(Request $request)
    {
        $batches = DB::table('products')
            ->join('batches', 'products.id', '=', 'batches.product_id')
            ->select(
                'products.name as product_name',
                'products.id as product_id',
                'products.alert_quantity',
                DB::raw('SUM(batches.available_quantity) as available_quantity'),
                DB::raw('MAX(batches.unit_purchase_price) as current_price')
            )
            ->groupBy('products.id', 'products.name', 'products.alert_quantity')
            ->having('available_quantity', '<', DB::raw('products.alert_quantity'))
            ->when($request->input('product_id'), function ($query) use ($request) {
                $query->where('products.id', $request->input('product_id'));
            })
            ->get();

        $results = [];
        foreach ($batches as $batch) {
            $results[] = [
                'product_id' => $batch->product_id,
                'product_name' => $batch->product_name,
                'alert_quantity' => $batch->alert_quantity,
                'available_quantity' => $batch->available_quantity,
                'current_price' => $batch->current_price,
            ];
        }
        return $results;
    }

    public function expiredReport()
    {
        $products = Product::with('batches')
            ->whereHas('batches', function ($query) {
                $query->where('expiry_date', '<', now());
            })
            ->get();

        $results = [];
        foreach ($products as $product) {
            $batches = $product->batches;
            if ($batches->isNotEmpty()) {
                foreach ($batches as $batch) {
                    if ($batch->expiry_date < now()) {
                        $results[] = [
                            'product_name' => $product->name,
                            'batch_number' => $batch->batch_number,
                            'expiry_date' => $batch->expiry_date,
                            'available_quantity' => $batch->available_quantity,
                        ];
                    }
                }
            }
        }

        return Inertia::render('Reports/Products/Expired', [
            'results' => $results
        ]);
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
