<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('Admin.pages.Setting.index');
    }

    public function edit()
    {
        return view('Admin.pages.Setting.edit');
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->update([
            'site_name' => $request->site_name,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'about_us_content' => nl2br($request->about_us_content)
        ]);

        return redirect()->route('settings.view')->with('success', 'Setting updated successfully');
    }
}
