<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Unit extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public static function laratablesCustomAction(Unit $unit)
    {
        $data = array(
            'unit'=>$unit,
        );
        return view('actions.unit_actions')->with($data)->render();
    }
    public static function laratablesCustomProducts(Unit $unit)
    {
        // return $unit->products->count();
        $products = $unit->products;
        $product_names = '';
        foreach($products as $product){
            $product_names .= $product->name.', ';
        }
        return rtrim($product_names,', ');
    }

    public static function laratablesAdditionalColumns()
    {
        return ['id'];
    }
}
