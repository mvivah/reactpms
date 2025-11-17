<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public static function laratablesCustomAction(Category $category)
    {
        $data = array(
            'category'=>$category,
        );
        return view('actions.category_actions')->with($data)->render();
    }

    public static function laratablesCustomProducts(Category $category)
    {
        // return $category->products->count();
        $products = $category->products;
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
