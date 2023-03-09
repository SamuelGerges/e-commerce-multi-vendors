<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function editShippingMethod($type)
    {
        // type = {free , inner , outer } for shipping method
        if ($type === 'free') {
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        } elseif ($type === 'inner') {
            $shippingMethod = Setting::where('key', 'local_shipping_label')->first();
        } elseif ($type === 'outer') {
            $shippingMethod = Setting::where('key', 'outer_shipping_label')->first();
        } else {
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('dashboard.settings.shippings.edit', compact('shippingMethod'));
    }

    public function updateShippingMethod($id, ShippingRequest $request)
    {
        try {
            // validation
            // update
            DB::beginTransaction();
            $shippingMethod = Setting::find($id);
            $shippingMethod->update([
                'plain_value' => $request->plain_value,
            ]);
            $shippingMethod->value = $request->value;
            $shippingMethod->save();
            DB::commit();
            return redirect()->back()->with(['success'=> __('admin/settings/shipping.success')]);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error'=> __('admin/settings/shipping.error')]);

        }
    }
}
