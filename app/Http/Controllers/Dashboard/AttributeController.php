<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Traits\Check;
use App\Traits\Upload;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    use Upload,Check;

    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('dashboard.attributes.create');
    }

    public function store(AttributeRequest $request)
    {
        try {
            DB::beginTransaction();
            $attribute = Attribute::create($request->except('_token', '_method'));
            $attribute->name = $request->name;
            $attribute->save();
            DB::commit();
            return redirect()->route('admin.index.attributes')->with(['success' => __('admin/attributes/attribute.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.attributes')->with(['error' => __('admin/attributes/attribute.error')]);

        }
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
//        return $attribute->translations->id;
        if (!$attribute)
            return redirect()->route('admin.index.attributes')
                ->with(['error' => __('admin/attributes/attribute.attribute_not_existed')]);
        return view('dashboard.attributes.edit', compact('attribute'));
    }
    public function update($id, AttributeRequest $request)
    {

        try {
            $attribute = Attribute::find($id);
            if (!$attribute)
                return redirect()->route('admin.index.attributes')
                    ->with(['error' => __('admin/attributes/attribute.attribute_not_existed')]);
            DB::beginTransaction();
            $attribute->update($request->except('_token','_method','id'));
            $attribute->name = $request->name;
            $attribute->save();
            DB::commit();
            return redirect()->route('admin.index.attributes')->with(['success' => __('admin/attributes/attribute.updated')]);
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
            $attribute = Attribute::find($id);
            if (!$attribute)
                return redirect()->route('admin.index.attributes')
                    ->with(['error' => __('admin/attributes/attribute.attribute_not_existed')]);
            $attribute->translations()->delete();
            $attribute->delete();
            DB::commit();
            return redirect()->route('admin.index.attributes')->with(['success' => __('admin/attributes/attribute.deleted')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.attributes')->with(['error' => __('admin/attributes/attribute.error')]);

        }
    }
}
