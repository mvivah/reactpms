<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    protected $fillable = [
        'product_id',
        'receipt_id',
        'invoice_id',
        'purchase_id',
        'supplier_id',
        'batch_number',
        'expiry_date',
        'received_quantity',
        'available_quantity',
        'purchase_price',
        'selling_price',
        'unit_purchase_price',
        'unit_selling_price',
        'created_by',
        'updated_by',
    ];
}
