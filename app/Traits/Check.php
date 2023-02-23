<?php

namespace App\Traits;

//use App\Models\$model;

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


    public function isParent($request,$prent_id)
    {
        if($request->type === '1'){
            $request->request->add([$prent_id => null]);
        }
    }
    public function check($object, $route, $message,$view)
    {
        if (!$object)
            return redirect()->route($route)->with(['error' => __($message)]);
        return view($view, compact('object'));
    }
}
