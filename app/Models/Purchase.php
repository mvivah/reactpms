<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Batch::class, 'product_purchase')
                    ->withPivot('quantity', 'purchase_price')
                    ->withTimestamps();
    }
    public function items()
    {
        return $this->hasMany(Batch::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    //has one receipt
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }
    public function getReceiptNumberAttribute()
    {
        return $this->receipt ? $this->receipt->receipt_number : null;
    }
    public function getReceiptAmountAttribute()
    {
        return $this->receipt ? $this->receipt->receipt_amount : null;
    }
    public function getInvoiceNumberAttribute()
    {
        return $this->invoice ? $this->invoice->invoice_number : null;
    }
    //has one invoice
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public static function laratablesCustomAction(Purchase $purchase)
    {
        $data = array(
            'purchase'=>$purchase,
        );
        return view('actions.purchase_actions')->with($data)->render();
    }
    public static function laratablesCustomNumber(Purchase $purchase)
    {
        if($purchase->payment_type == 'Cash'){
            if(!empty($purchase->receipt) &&($purchase->receipt != null)){
            return 'RECEIPT - '.$purchase->receipt->receipt_number;
            }else{
                return '';
            }
        }else{
            if(!empty($purchase->invoice) &&($purchase->invoice != null)){
            return 'INVOICE - '.$purchase->invoice->invoice_number;
            }else{
                return '';
            }
        }
    }
    //ReceiptAmount
    public static function laratablesCustomAmount(Purchase $purchase)
    {
        if($purchase->payment_type == 'Cash'){
            if(!empty($purchase->receipt) &&($purchase->receipt != null)){
            return $purchase->receipt->receipt_amount;
            }else{
                return '';
            }
        }else{
            if(!empty($purchase->invoice) &&($purchase->invoice != null)){
                return $purchase->invoice->invoice_amount;
            }else{
                return '';
            }
        }
    }

    public static function laratablesAdditionalColumns()
    {
        return ['id','payment_type'];
    }
}
