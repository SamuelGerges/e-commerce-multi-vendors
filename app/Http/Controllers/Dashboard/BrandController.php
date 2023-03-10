<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Traits\Check;
use App\Traits\Upload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use Upload, Check;

    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }

    public function store(BrandRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->isActive($request, 'is_active');
            $fileName = '';
            if ($request->has('image')) {
                $fileName = $this->uploadImage($request->image, 'brands');

            }
            $brand = Brand::create($request->except('_token', 'image'));
            $brand->name = $request->name;
            $brand->image = $fileName;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.index.brands')->with(['success' => __('admin/brands/brand.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.brands')->with(['error' => __('admin/brands/brand.error')]);

        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        if (!$brand)
            return redirect()->route('admin.index.brands')
                ->with(['error' => __('admin/brands/brand.brand_not_existed')]);
        return view('dashboard.brands.edit', compact('brand'));
    }

    public function update($id, BrandRequest $request)
    {
        try {
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.index.brands')
                    ->with(['error' => __('admin/brands/brand.brand_not_existed')]);

            DB::beginTransaction();

            $this->isActive($request, 'is_active');
            $fileName = '';
            if ($request->has('image')) {
                try {
                    Storage::disk('assets')->delete($brand->getImage($brand->id));
//                    unlink(public_path('assets/'.$brand->getImage($brand->id)));
                } catch (\Exception $e) {

                }
                $fileName = $this->uploadImage($request->image, 'brands');
                $brand->update([
                    'image' => $fileName
                ]);
            }
            $brand->update($request->except('_token', '_method', 'image'));

            $brand->name = $request->name;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.index.brands')->with(['success' => __('admin/brands/brand.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.brands')->with(['error' => __('admin/brands/brand.error')]);

        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.index.brands')
                    ->with(['error' => __('admin/brands/brand.brand_not_existed')]);
            try {
                Storage::disk('assets')->delete($brand->getImage($brand->id));
            } catch (\Exception $e) {

            }
            $brand->translations()->delete();
            $brand->delete();
            DB::commit();
            return redirect()->route('admin.index.brands')->with(['success' => __('admin/brands/brand.deleted')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.brands')->with(['error' => __('admin/brands/brand.error')]);

        }
    }
}
