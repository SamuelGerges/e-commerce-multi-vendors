<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data = [];
        $data['sliders'] = Slider::select('image')->get();
        $data['categories'] = Category::selection()->parent()
            ->with(['children' => function ($q) {
                $q->with('children');
            }])->get();
        return view('front.home', $data);
    }
}
