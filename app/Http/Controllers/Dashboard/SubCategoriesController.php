<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class SubCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::child()->orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.subCategories.index', compact('categories'));
    }

    public function create()
    {
        $mainCategory = Category::parent()->get();
        return view('dashboard.subCategories.create',compact('mainCategory'));
    }

    public function store(SubCategoryRequest $request)
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
            return redirect()->route('admin.index.subCategories')->with(['success' => __('admin/subCategories/category.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.subCategories')->with(['error' => __('admin/subCategories/category.error')]);

        }
    }

    public function edit($main_cat_id)
    {
         $subCategory = Category::find($main_cat_id);
        if (!$subCategory)
            return redirect()->route('admin.index.subCategories')
                ->with(['error' => __('admin/subCategories/category.cat_not_existed')]);
        $mainCategory = Category::parent()->orderBy('id','DESC')->get();
        return view('dashboard.subCategories.edit', compact('subCategory','mainCategory'));
    }

    public function update($id, SubCategoryRequest $request)
    {
        try {
            $subCategory = Category::find($id);
            if (!$subCategory)
                return redirect()->route('admin.index.subCategories')
                    ->with(['error' => __('admin/subCategories/category.cat_not_existed')]);
            DB::beginTransaction();
            if (!$request->has('is_active')) {
                $request->request->add(['is_active' => 0]);
            } else {
                $request->request->add(['is_active' => 1]);
            }

            $subCategory->update($request->all());
            $subCategory->name = $request->name;
            $subCategory->save();
            DB::commit();
            return redirect()->route('admin.index.subCategories')->with(['success' => __('admin/subCategories/category.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.subCategories')->with(['error' => __('admin/subCategories/category.error')]);

        }
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.index.subCategories')
                    ->with(['error' => __('admin/subCategories/category.cat_not_existed')]);
            $category->delete();
            return redirect()->route('admin.index.subCategories')->with(['success' => __('admin/subCategories/category.deleted')]);
        } catch (\Exception $e) {
            return redirect()->route('admin.index.subCategories')->with(['error' => __('admin/subCategories/category.error')]);

        }
    }
}
