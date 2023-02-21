<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::parent()->orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.mainCategories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.mainCategories.create');
    }

    public function store(MainCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }
            $category = Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/mainCategories/category.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/mainCategories/category.error')]);

        }
    }

    public function edit($main_cat_id)
    {
        $mainCategory = Category::find($main_cat_id);
        if (!$mainCategory)
            return redirect()->route('admin.index.categories')
                ->with(['error' => __('admin/mainCategories/category.cat_not_existed')]);
        return view('dashboard.mainCategories.edit', compact('mainCategory'));
    }

    public function update($id, MainCategoryRequest $request)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.index.categories')
                    ->with(['error' => __('admin/mainCategories/category.cat_not_existed')]);
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $category->update($request->all());
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/mainCategories/category.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/mainCategories/category.error')]);

        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.index.categories')
                    ->with(['error' => __('admin/mainCategories/category.cat_not_existed')]);
            $category->delete();
            return redirect()->route('admin.index.categories')->with(['success' => __('admin/mainCategories/category.deleted')]);
        } catch (\Exception $e) {
            return redirect()->route('admin.index.categories')->with(['error' => __('admin/mainCategories/category.error')]);

        }
    }
}
