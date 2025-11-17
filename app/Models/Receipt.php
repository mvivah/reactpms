<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'supplier_id',
        'purchase_id',
        'receipt_number',
        'amount',
        'payment_date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function items()
    {
        return $this->hasMany(Batch::class);
    }
    public static function laratablesCustomAction(Receipt $receipt)
    {
        $data = array(
            'receipt'=>$receipt,
        );
        return view('actions.receipt_actions')->with($data)->render();
    }
    //get receipt amount attribute
    public function getReceiptAmountAttribute()
    {
        return $this->items->sum('purchase_price');

    }

    public static function laratablesCustomReceiptNumber(Receipt $receipt)
    {
        return '<a class="text-info" style="text-decoration: none; font-size: small;" href="' . 
        route('purchases.show', ['purchase' => $receipt->id, 'Cash']) . '">'. $receipt->receipt_number .'</a>';
    }
    public static function laratablesCustomReceiptAmount(Receipt $receipt)
    {
        return $receipt->ReceiptAmount;
    }
    public static function laratablesAdditionalColumns()
    {
        return ['receipt_number'];
    }
}
