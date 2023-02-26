<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockProductRequest;
use App\Http\Requests\StockRequest;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\PriceProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use App\Traits\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use Check;

    public function index()
    {
        $products = Product::select()->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index', compact('products'));
    }

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
        return view('dashboard.products.general.create', $data);
    }

    public function store(GeneralProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->isActive($request, 'is_active');
            $product = Product::create($request->except('_token'));

            // save transactions
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            // save category in product_categories
            $product->categories()->attach($request->categories);
            // save tags in product_categories
            $product->tags()->attach($request->tags);

            DB::commit();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/categories/category.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/categories/category.error')]);

        }
    }

    public function edit($product_id)
    {
        $data = [];
        $data['product'] = Product::with('categories', 'tags')->find($product_id);
        if (!$data['product'])
            return redirect()->route('admin.index.products')
                ->with(['error' => __('admin/products/product.product_not_existed')]);
        $data['categories'] = Category::orderBy('id', 'DESC')->get();
        $data['tags'] = Tag::orderBy('id', 'DESC')->get();
        $data['brands'] = Brand::orderBy('id', 'DESC')->get();
        return view('dashboard.products.general.edit', $data);
    }

    public function update($id, GeneralProductRequest $request)
    {
        try {
            $product = Product::find($id);
            if (!$product)
                return redirect()->route('admin.index.products')
                    ->with(['error' => __('admin/products/product.product_not_existed')]);
            DB::beginTransaction();

            // update data in products
            $this->isActive($request, 'is_active');
            $product->update($request->except('_token'));
            // update translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();
            // save category in product_categories
            $product->categories()->sync($request->categories);
            // save tags in product_categories
            $product->tags()->sync($request->tags);
            DB::commit();
            return redirect()->route('admin.index.products')->with(['success' => __('admin/products/product.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.products')->with(['error' => __('admin/products/product.error')]);

        }
    }

    public function getPrice($id)
    {
        return view('dashboard.products.prices.create', compact('id'));
    }

    public function updatePrice($id, PriceProductRequest $request)
    {
        try {
            DB::beginTransaction();
            Product::whereId($request->product_id)->update($request->except('_token', '_method', 'product_id'));
            DB::commit();
            return redirect()->route('admin.index.products')->with(['success' => __('admin/products/product.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.products')->with(['error' => __('admin/products/product.error')]);

        }
    }

    public function getStock($id)
    {
        return view('dashboard.products.stocks.create', compact('id'));
    }

    public function updateStock($id, StockProductRequest $request)
    {
        try {
            DB::beginTransaction();
            Product::whereId($request->product_id)->update($request->except('_token', '_method', 'product_id'));
            DB::commit();
            return redirect()->route('admin.index.products')->with(['success' => __('admin/products/product.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.products')->with(['error' => __('admin/products/product.error')]);

        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.index.categories')
                    ->with(['error' => __('admin/categories/category.cat_not_existed')]);
            $category->delete();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/categories/category.deleted')]);
        } catch (\Exception $e) {
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/categories/category.error')]);

        }
    }
}
