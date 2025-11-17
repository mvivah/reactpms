<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'supplier_id',
        'purchase_id',
        'invoice_number',
        'due_date',
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
    public static function laratablesCustomDaysLeft(Invoice $invoice)
    {
        //get days left to due date
        $dueDate = $invoice->due_date;
        $now = date('Y-m-d');
        $diff = strtotime($dueDate) - strtotime($now);
        $days = abs(round($diff / 86400));
        if ($invoice->payment_date) {
            return 'N/A';
        }
        return $days.' days left';
    }
    //DaysOverDue
    public static function laratablesCustomDaysOverDue(Invoice $invoice)
    {
        $dueDate = $invoice->due_date;
        $now = date('Y-m-d');
        $diff = strtotime($dueDate) - strtotime($now);
        $days = abs(round($diff / 86400));
        if ($invoice->payment_date) {
            return 'N/A';
        }
        if ($days < 0) {
            return abs($days).' days overdue';
        } else {
            return 0;
        }
    }
    public static function laratablesCustomAction(Invoice $invoice)
    {
        $data = array(
            'invoice'=>$invoice,
        );
        return view('actions.invoice_actions')->with($data)->render();
    }
    public function getInvoiceAmountAttribute()
    {
        return $this->items->sum('purchase_price');

    }
    public static function laratablesCustomInvoiceNumber(Invoice $invoice)
    {
        return '<a class="text-info" style="text-decoration: none; font-size: small;" href="' . 
               route('purchases.show', ['purchase' => $invoice->id, 'Credit']) . '">'. $invoice->invoice_number .'</a>';
    }
    public static function laratablesCustomInvoiceAmount(Invoice $invoice)
    {
        return $invoice->InvoiceAmount;
    }
    //additional columns
    public static function laratablesAdditionalColumns()
    {
        return ['invoice_number'];
    }
}
