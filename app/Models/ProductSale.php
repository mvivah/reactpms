<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $fillable = [
        'product_id',
        'sale_id',
        'batch_id',
        'product_quantity',
        'unit_sale_price',
        'total_charge',
        'sales_date',
        'created_by',
        'updated_by',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public static function laratablesCustomAction(ProductSale $product_sale)
    {
        $sale = $product_sale->sale;
        $data = array(
            'sale'=>$sale,
        );
        return view('actions.sale_actions')->with($data)->render();
    }
    public static function laratablesCustomTotalAmount(ProductSale $product_sale)
    {
        return number_format($product_sale->total_charge);
    }
    public static function laratablesAdditionalColumns()
    {
        return ['total_charge'];
    }
}
