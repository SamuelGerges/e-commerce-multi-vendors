<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use App\Traits\Check;
use App\Traits\Upload;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    use Upload,Check;

    public function index()
    {
        $options = Option::with('product','attribute')->select()->paginate(PAGINATION_COUNT);
        return view('dashboard.options.index', compact('options'));
    }

    public function create()
    {
        $data =[];
        $data['attributes'] = Attribute::select('id')->get();
        $data['products'] = Product::select('id','is_active')->active()->get();

//        return $data;
        return view('dashboard.options.create',$data);
    }

    public function store(OptionRequest $request)
    {
        try {
            DB::beginTransaction();
            $option = Option::create($request->except('_token', '_method'));
            $option->name = $request->name;
            $option->save();
            DB::commit();
            return redirect()->route('admin.index.options')->with(['success' => __('admin/options/option.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('admin.index.options')->with(['error' => __('admin/options/option.error')]);

        }
    }

    public function edit($id)
    {
        $data =[];
        $data['option'] = Option::find($id);
        if (!$data['option'])
            return redirect()->route('admin.index.options')
                ->with(['error' => __('admin/options/option.option_not_existed')]);
        $data['attributes'] = Attribute::select('id')->get();
        $data['products'] = Product::select('id','is_active')->active()->get();
//        return $data;
        return view('dashboard.options.edit', $data);
    }
    public function update($id, OptionRequest $request)
    {

        try {
//            return $request;
            $option = Option::find($id);
            if (!$option)
                return redirect()->route('admin.index.options')
                    ->with(['error' => __('admin/options/option.option_not_existed')]);
            DB::beginTransaction();
            $option->update($request->except('_token','_method'));
            $option->name = $request->name;
            $option->save();
            DB::commit();
            return redirect()->route('admin.index.options')->with(['success' => __('admin/options/option.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->route('admin.index.attributes')->with(['error' => __('admin/attributes/attribute.error')]);

        }
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $option = Option::find($id);
            if (!$option)
                return redirect()->route('admin.index.options')
                    ->with(['error' => __('admin/options/option.option_not_existed')]);
//            $option->translations()->delete();
            $option->delete();
            DB::commit();
            return redirect()->route('admin.index.options')->with(['success' => __('admin/options/option.deleted')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.options')->with(['error' => __('admin/options/option.error')]);

        }
    }
}
