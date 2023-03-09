<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.roles.create');
    }

    public function store(RolesRequest $request)
    {
        try {
            $role = $this->process(new Role, $request);
            if ($role)
                return redirect()->route('admin.index.roles')->with(['success' => __('admin/brands/brand.created')]);
            else
                return redirect()->route('admin.index.roles')->with(['error' => __('admin/brands/brand.error')]);

        } catch (\Exception $e) {
            return $e;
            return redirect()->route('admin.index.roles')->with(['error' => __('admin/brands/brand.error')]);

        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.roles.edit',compact('role'));
    }

    public function update($id,RolesRequest $request)
    {
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role)
                return redirect()->route('admin.index.roles')->with(['success' => __('admin/brands/brand.updated')]);
            else
                return redirect()->route('admin.index.roles')->with(['error' => __('admin/brands/brand.error')]);

        } catch (\Exception $e) {
            return $e;
            return redirect()->route('admin.index.roles')->with(['error' => __('admin/brands/brand.error')]);

        }
    }

    protected function process(Role $role, Request $request)
    {
        $role->name = $request->name;
        $role->permissions = json_encode($request->permissions);
        $role->save();
        return $role;
    }
}
