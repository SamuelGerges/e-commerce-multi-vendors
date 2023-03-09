<?php

namespace App\Http\Controllers\Site;

use App\Basket\Basket;
use App\Exceptions\QuantityExceededException;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * @var Basket
     */
    protected $basket;
    protected $id;

    /**
     * @param Basket $basket
     */
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }


    public function getIndex()
    {
        $basket = $this->basket;
        return view('front.cart.index', compact('basket'));
    }


    public function postAdd(Request $request)
    {
        $slug = $request->product_slug;
        $product = Product::where('slug', $slug)->firstOrFail();

        try {
            //        return 'Product added successfully to the card ';
            $this->basket->add($product, $request->quantity ?? 1);
            return response()->json(['status' => true, 'cart' => true]);

        } catch (QuantityExceededException $e) {
            return response()->json(['status' => true, 'cart' => false]);
//            return 'Quantity Exceeded';  // must be trans as the site is multi languages
        }
    }

    public function postUpdate($slug, Request $request)
    {
        $_product = Product::where('slug', $slug)->firstOrFail();

        try {
            $this->basket->update($_product, $request->quantity);
        } catch (QuantityExceededException $e) {
            return trans('site.cart.msgs.exceeded');
        }

        if (!$request->quantity) {
            return array_merge([
                'total' => num_format($this->basket->subTotal()) . " (" . money('symbol') . ")"
            ], trans('site.cart.msgs.removed'));
        }

        return trans('site.cart.msgs.updated');
    }

    public function postUpdateAll(Request $r)
    {
        if (!$r->has('quantities') || !$this->basket->itemCount()) {
            return trans('site.cart.msgs.empty');
        }

        foreach ($this->basket->all() as $index => $item) {
            try {
                $this->basket->update($item, $r->quantities[$index]);
            } catch (QuantityExceededException $e) {
                return trans('site.cart.msgs.exceeded');
            }
        }

        return trans('site.cart.msgs.updated');
    }


}
