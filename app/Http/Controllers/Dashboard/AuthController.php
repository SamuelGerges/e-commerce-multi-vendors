<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('dashboard.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {

//        $remember_me = $request->has("remember_me") ? true : false;
        $guard = auth('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        if($guard){
            return redirect()->route('admin.home');
        }
        return redirect()->back()->with(['error' => 'فشل في تسجيل الدخول']);

    }

    public function logout()
    {
        try {
            $guard = $this->getGuard('admin');
            $guard->logout();
            return redirect()->route('admin.login');
        }catch(\Exception $e){

        }
    }

    private function getGuard($guard){
        return auth($guard);
    }

}
