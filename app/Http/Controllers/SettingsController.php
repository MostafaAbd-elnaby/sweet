<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use http\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function show () {
        return response()->json(Settings::first());
    }

    public function test () {
    }

    public function setting ( Request $req) {

        if ($req->id)
            $setting = Settings::find($req->id);
        else
            $setting = new settings();

        if ($req->hasFile('logo')) :
            if($setting->logo != null)
                Storage::delete('public/' . $setting->logo);
            $setting->logo = env('BACK_URL') . substr($req->file('logo')->store('public/logo'), 7);
        endif;

        if ($req->hasFile('img_large')) :
            if($setting->img_large != null)
                Storage::delete('public/' . $setting->img_large);
            $setting->img_large = env('BACK_URL') . substr($req->file('img_large')->store('public/img_large'), 7);
        endif;

        if ($req->hasFile('img_small')) :
            if($setting->img_small != null)
                Storage::delete('public/' . $setting->img_small);
            $setting->img_small = env('BACK_URL') . substr($req->file('img_small')->store('public/img_small'), 7);
        endif;

        if ($req->hasFile('banner')) :
            if($setting->banner != null)
                Storage::delete('public/' . $setting->banner);
            $setting->banner = env('BACK_URL') . substr($req->file('banner')->store('public/banner'), 7);
        endif;

        $sliders = json_decode($req->sliders, true);

        if ($req->hasFile('slidersImgLarge')) :

            foreach( $req->file("slidersImgLarge") as $key => $slider ) {
                $imgName = substr($slider->store('public/slider'), 7);
                $sliders[$key]['img_large'] = env('BACK_URL') . $imgName;
            };

        endif;
        if ($req->hasFile('slidersImgSmall')) :

            foreach( $req->file("slidersImgSmall") as $key => $slider ) {
                $imgName = substr($slider->store('public/slider'), 7);
                $sliders[$key]['img_small'] = env('BACK_URL') . $imgName;
            };

        endif;

        $setting->info    = json_decode($req->info, TRUE);
        $setting->about   = json_decode($req->about, TRUE);
        $setting->sliders = $sliders;
        $setting->price   = $req->price;
        $setting->books   = json_decode($req->books, TRUE);
        $setting->save();

        return response()->json($setting);
    }
}
