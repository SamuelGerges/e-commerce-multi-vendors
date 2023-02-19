<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = Admin::find(auth('admin')->user()->id);
        return view('dashboard.profiles.edit', compact('admin'));
    }

    public function update(ProfileRequest $request)
    {
        try {
            $admin = Admin::find(auth('admin')->user()->id);
            $admin->update($request->validated());
            return redirect()->back()->with(['success' => __('admin/profiles/profile.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('admin/profiles/profile.error')]);

        }
    }

    public function editPassword()
    {
        return view('dashboard.profiles.editPassword');
    }

    public function updatePassword(PasswordRequest $request)
    {
        try {
            $admin = Admin::find(auth('admin')->user()->id);
            $admin->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->back()->with(['success' => __('admin/profiles/profile.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('admin/profiles/profile.error')]);

        }
    }
}
