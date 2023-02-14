<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function postLogin(AdminLoginRequest $request)
    {
//        $remember_me = $request->has("remember_me") ? true : false;
        $guard = auth()->guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        if($guard){
            return redirect()->route('admin.home');
        }
        return redirect()->back()->with(['error' => 'فشل في تسجيل الدخول']);

    }
}
