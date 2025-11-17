<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = [
        'name',
        'alert_quantity',
        'category_id',
        'brand_id',
        'unit_id',
        'image',
        'status',
    ];
    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class)->withPivot('batch_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function purchasedetails()
    {
        return $this->hasMany(Purchasedetail::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
    //get current batch attribute
    public function getCurrentBatchAttribute()
    {
        //get the batch with the oldest expiry date and remaining quantity greater than 0
        return $this->purchasedetails()->with('inventories')->where('remaining_quantity','>',0)->orderBy('expiry_date','asc')->first();
    }
    public function getCurrentInventoryAttribute()
    {
        return $this->inventories->last();
    }
    public static function laratablesCustomSuupliers(Product $product)
    {
        $suppliers = $product->suppliers->unique('id');
        $suppliers_name = '';
        foreach ($suppliers as $supplier) {
            $suppliers_name .= $supplier->name.', ';
        }
        return $suppliers_name;

    }
    public static function laratablesCustomAction(Product $product)
    {
        $data = array(
            'product'=>$product,
        );
        return view('actions.product_actions')->with($data)->render();
    }
    public static function laratablesCustomCategories(Product $product)
    {
        $categories = $product->categories;
        $categories_name = '';
        foreach ($categories as $subcategory) {
            $categories_name .= $subcategory->name.', ';
        }
        return $categories_name;
    }
    public static function laratablesCustomCurrentQuantity(Product $product)
    {
        $inventory = $product->current_inventory;
        if($inventory){
            return $inventory->remaining_quantity;
        }
        return 0;

    }
    public static function laratablesCustomSuppliers(Product $product)
    {
        $suppliers = $product->suppliers;
        $suppliers_name = '';
        foreach ($suppliers as $supplier) {
            $suppliers_name .= $supplier->name.', ';
        }
        return $suppliers_name;
    }
    public static function laratablesAdditionalColumns()
    {
        return ['id'];
    }
}
