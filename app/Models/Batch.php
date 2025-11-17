<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class );
    }
    
    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sale')
                    ->withPivot('quantity', 'sale_price')
                    ->withTimestamps();
    }
    public static function laratablesCustomExpiryStatus(Batch $batch)
    {
        $expiry_date = $batch->expiry_date;
        $today = date('Y-m-d');
        if($expiry_date < $today){
            return '<span class="badge bg-danger">Expired</span>';
        }elseif($expiry_date < date('Y-m-d', strtotime('+6 months'))){
            return '<span class="badge bg-warning">Expiring</span>';
        }else{
            return '<span class="badge bg-success">Valid</span>';
        }
    }
    public static function laratablesCustomAction(Batch $batch)
    {
        $data = array(
            'batch'=>$batch,
        );
        return view('actions.batch_actions')->with($data)->render();
    }
    public static function laratablesCustomUnitOfMeasure(Batch $batch)
    {
        return $batch->product->unit->name;
    }

}
