<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Traits\Check;
use App\Traits\Upload;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    use Upload, Check;

    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(TagRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = Tag::create($request->except('_token'));
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.index.tags')->with(['success' => __('admin/tags/tag.created')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.tags')->with(['error' => __('admin/tags/brand.error')]);

        }
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        if (!$tag)
            return redirect()->route('admin.index.tags')
                ->with(['error' => __('admin/tags/tag.tag_not_existed')]);
        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update($id, TagRequest $request)
    {
        try {
            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.index.tags')
                    ->with(['error' => __('admin/tags/tag.tag_not_existed')]);

            DB::beginTransaction();
            $tag->update($request->except('_token', 'id'));   // update for slug only
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.index.tags')->with(['success' => __('admin/tags/tag.updated')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.index.tags')->with(['error' => __('admin/tags/tag.error')]);

        }
    }

    public function delete($id)
    {
        try {
            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.index.tags')
                    ->with(['error' => __('admin/tags/tag.tag_not_existed')]);
//            $tag->translations->delete();
            $tag->delete();
            return redirect()->route('admin.index.tags')->with(['success' => __('admin/tags/tag.deleted')]);
        } catch (\Exception $e) {
            return redirect()->route('admin.index.tags')->with(['error' => __('admin/tags/tag.error')]);

        }
    }
}
