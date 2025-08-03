<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.system.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'inventory_threshold' => 'nullable|integer',
            'supplier_info' => 'nullable|string',
            'notification_email' => 'nullable|email',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('status', 'System settings updated');
    }
}

