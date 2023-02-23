<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use Check;
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::select('id','parent_id')->get();
        return view('dashboard.categories.create',compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->isActive($request,'is_active');
            $this->isParent($request,'type','parent_id');
            $category = Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/categories/category.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/categories/category.error')]);

        }
    }

    public function edit($main_cat_id)
    {
        $category = Category::find($main_cat_id);
        if (!$category)
            return redirect()->route('admin.index.categories')
                ->with(['error' => __('admin/categories/category.cat_not_existed')]);
        $categories = Category::orderBy('id','DESC')->get();
        return view('dashboard.categories.edit', compact('category','categories'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.index.categories')
                    ->with(['error' => __('admin/categories/category.cat_not_existed')]);
            DB::beginTransaction();

            $this->isActive($request,'is_active');
            $this->isParent($request,'type','parent_id');

            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/categories/category.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/categories/category.error')]);

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
