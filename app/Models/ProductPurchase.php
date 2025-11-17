<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    protected $fillable = [
        'product_id',
        'purchase_id',
        'batch_id',
        'received_quantity',
        'purchase_price',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function batch(){
        return $this->belongsTo(Batch::class);
    }
}
