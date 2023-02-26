<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
  
    public function index()
    {
        $settings = [];
        $result = SettingResource::collection(Setting::all());
        foreach ($result as $obj) {
            $settings[$obj->key] = $obj->value;
        }
        return view('dashboard.settings',compact('settings'));
    }
    public function update(UpdateRequest $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                if ($settings = Setting::where('key', $key)->first()) {
                    $settings->value = $value;
                    $settings->save();
                }
            }
            toastr()->success('','The settings has been successfully updated');
            return redirect()->route('dashboard.settings.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
