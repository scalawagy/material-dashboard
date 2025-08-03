<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'app_name' => 'nullable|string',
            'logo'     => 'nullable|image',
            'contact'  => 'nullable|string',
            'address'  => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            if ($key === 'logo' && $request->hasFile('logo')) {
                $path = $request->file('logo')->store('logos', 'public');
                Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
            } else {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        return redirect()->back()->with('status', 'Settings updated');
    }
}

