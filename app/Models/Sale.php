<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Sale extends Model
{
    protected $fillable = [
        'customer_id',
        'amount_due',
        'amount_received',
        'customer_balance',
        'quantity_sold',
        'created_by',
        'sales_date',
        'shift',
        'receipt_number'
    ];
    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'actionable')->withTrashed();
    }
    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function details()
    {
        return $this->hasMany(ProductSale::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'product_batch_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return date("d M Y", strtotime($value));
    }
    public static function laratablesCustomReceiptNumber(Sale $sale)
    {
        return '<a class="text-info" style="text-decoration: none; font-size: small;" href="' . route('sales.show', $sale->id) . '" title="View Sale">
                    ' . $sale->receipt_number . '
                </a>';
    }
    //   public static function laratablesCustomCustomerId(Sale $sale)
    // {
    //     return '<a class="text-info" style="text-decoration: none; font-size: small;" href="' . route('sales.show', $sale->id) . '" title="View Sale">
    //                 ' . $sale->customer_id . '
    //             </a>';
    // }
    public static function laratablesCustomAction(Sale $sale)
    {
        $data = array(
            'sale'=>$sale,
        );
        return view('actions.sale_actions')->with($data)->render();
    }
    public static function laratablesCustomTotalAmount(Sale $sale)
    {
        return number_format($sale->details->sum('total_charge'));
    }
    public static function laratablesAdditionalColumns()
    {
        return ['id','customer_id','receipt_number'];
    }
}
