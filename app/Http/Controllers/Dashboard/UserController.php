<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Admin::latest()->where('id','<>',auth()->id())->get();
        return view('dashboard.users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('dashboard.users.create',compact('roles'));

    }

    public function store(AdminRequest $request)
    {
        try {
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => bcrypt($request->password),
            ]);
            return redirect()->route('admin.index.users')->with(['success' => __('admin/categories/category.created')]);
        } catch (\Exception $e) {
            return $e;
            return redirect()->route('admin.index.users')->with(['error' => __('admin/categories/category.error')]);

        }
    }
}
