<?php

namespace App\Traits;

//use App\Models\$model;

use App\Http\Enumerations\CategoryType;

trait Check
{
    public function isActive($request, $status)
    {
        if (!$request->has($status)) {
            $request->request->add([$status => 0]);
        } else {
            $request->request->add([$status => 1]);
        }
    }


    public function isParent($request,$name_input,$parent_id)
    {
        if($request->$name_input == CategoryType::mianCategory){
            $request->request->add([$parent_id => null]);
        }
    }
    public function check($object, $route, $message,$view)
    {
        if (!$object)
            return redirect()->route($route)->with(['error' => __($message)]);
        return view($view, compact('object'));
    }
}
