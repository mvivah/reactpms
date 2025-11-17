<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = [];
    public function sale()
    {
        return $this->morphTo('actionable');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return date("d M Y", strtotime($value));
    }
    public static function laratablesCustomAction(Inventory $inventory)
    {
        $data = array(
            'inventory'=>$inventory,
        );
        return view('actions.inventory_actions')->with($data)->render();
    }
}
