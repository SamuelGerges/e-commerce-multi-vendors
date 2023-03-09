<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsBySlug($slug)
    {
        $data = [];
        $data['product'] = Product::where('slug', $slug)->first();
        if (!$data['product']) {  // redirect to previous page
            return "the product not found";
        }
        $product_id = $data['product']->id;   // return id of product
        $product_categories_ids = $data['product']->categories->pluck('id');   /// get all categories that product is existed
        $data['product_attributes'] = Attribute::whereHas('options', function ($q) use ($product_id) {
            $q->whereHas('product', function ($qq) use ($product_id) {
                $qq->where('product_id', $product_id);
            });
        })->get();

        $data['related_product'] = Product::whereHas('categories', function ($cat) use ($product_categories_ids) {
            $cat->whereIn('categories.id', $product_categories_ids);
        })->limit(20)->latest()->get();

        return view('front.products-details',$data);
    }
}
