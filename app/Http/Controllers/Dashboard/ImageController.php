<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesProductRequest;
use App\Traits\Check;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
class ImageController extends Controller
{
    use Check,Upload;

    // upload images
    public function addImages($id)
    {
        return view('dashboard.products.images.create', compact('id'));
    }

    public function saveProductImages(Request $request)
    {
        $file = $request->file('images');
        $filename = $this->uploadImage($file,'products');
        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }
    public function updateImages(ImagesProductRequest $request)
    {
        try {
            DB::beginTransaction();
            if($request->has('images') && count($request->images) > 0)
                foreach ($request->images as $key => $image){
                    Image::create([
                        'product_id' => $request->input('product_id'),
                        'image' => $image
                    ]);
            }
            DB::commit();
            return redirect()->route('admin.index.products')->with(['success' => __('admin/products/product.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('admin.index.products')->with(['error' => __('admin/products/product.error')]);

        }
    }







}
