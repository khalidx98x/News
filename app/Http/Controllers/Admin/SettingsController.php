<?php

namespace App\Http\Controllers\Admin;
use App\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    //


    protected $page_name = 'System Settings Page';

    public function index(){
        $system_name = Setting::where('id','1')->first()->value;

    return view('admin.settings.index')->with([
            'page_name'=>$this->page_name,
            'system_name'=>$system_name
        ]);
    }


    public function update(Request $request){
        $request->validate([
            'system_name'=>'required'
        ]);

            Setting::where('id','1')->update(['value'=>$request->system_name]);

        if($request->has('favicon')){
            $fav_settings = Setting::find(2);
            Storage::disk('public_uploads')->delete('others/'.$fav_settings->value);
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension();
             $image_name = 'favicon.'.$extension;
             Image::make($file)->save(public_path('uploads\others/'.$image_name));

            $fav_settings->value=$image_name;
            $fav_settings->save();

        }

        if($request->has('front_logo')){
            $front_settings = Setting::find(3);
            Storage::disk('public_uploads')->delete('others/'.$front_settings->value);
            $file = $request->file('front_logo');
            $extension = $file->getClientOriginalExtension();
             $image_name = 'front_logo.'.$extension;
             Image::make($file)->save(public_path('uploads\others/'.$image_name));

             $front_settings->value=$image_name;
             $front_settings->save();

        }

        if($request->has('admin_logo')){
            $admin_settings = Setting::find(4);
            Storage::disk('public_uploads')->delete('others/'.$admin_settings->value);

            $file = $request->file('admin_logo');
            $extension = $file->getClientOriginalExtension();
             $image_name = 'admin_logo.'.$extension;
             Image::make($file)->save(public_path('uploads\others/'.$image_name));
             $admin_settings->value=$image_name;
             $admin_settings->save();



        }
        return redirect()->route('settings.index')->with('success','The settings has been updated successfully !! ');
    }
}
