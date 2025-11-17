<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Supplier extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('batch_id');
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
    public static function laratablesCustomAction(Supplier $supplier)
    {
        $data = array(
            'supplier'=>$supplier,
        );
        return view('actions.supplier_actions')->with($data)->render();
    }
    public static function laratablesCustomIsActive(Supplier $supplier)
    {
        $checked = $supplier->is_active ? 'checked' : '';
        $url = route('suppliers.toggle-status');
        $html = '<div class="form-check form-switch">
                    <input class="form-check-input toggle-status" data-url="'.$url.'" type="checkbox" data-id="' . $supplier->id . '" ' . $checked . '>
                </div>';
        return $html;
    }
    
    public static function laratablesAdditionalColumns()
    {
        return ['id','is_active'];
    }

}
