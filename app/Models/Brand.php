<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public static function laratablesCustomAction(Brand $brand)
    {
        $data = array(
            'brand'=>$brand,
        );
        return view('actions.brand_actions')->with($data)->render();
    }
    public static function laratablesCustomProducts(Brand $brand)
    {
        return $brand->products->count();
    }

    public static function laratablesAdditionalColumns()
    {
        return ['id'];
    }
}
