<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\Upload;
use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    use Upload;
    public function index()
    {

    }

    public function create()
    {
        $images = Slider::select('image')->get();
        return view('dashboard.sliders.images.create',compact('images'));
    }

    public function saveSliderImages(Request $request)
    {
        $file = $request->file('images');
        $filename = $this->uploadImage($file,'sliders');

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(SliderRequest $request)
    {
        try {
            DB::beginTransaction();
            if($request->has('images') && count($request->images) > 0)
                foreach ($request->images as $key => $image){
                    Slider::create([
                        'image' => $image
                    ]);
                }
            DB::commit();
            return redirect()->back()->with(['success' => __('admin/sliders/slider.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with(['error' => __('admin/sliders/slider.error')]);

        }
    }
}
