<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function show () {
        return response()->json(brand::get());
    }

    public function CreateOrUpdate ( Request $req ) {
        $samBrand = brand::where('name', $req->name)->first();
        if ($samBrand)
            return response()->json(['error' => true]);

        if ($req->id)
            $brand = brand::find($req->id);
        else
            $brand = new brand();

        if ($req->hasFile('img')) :
            $brand->img ? Storage::delete('public/'.$brand->img) : '';
            $brand->img = substr($req->file('img')->store('public/brand'), 7);
        endif;

        $brand->name = $req->name;
        $brand->save();

        return response()->json($brand);
    }

    public function delete ( Request $req ) {

        $brand = brand::whereIn('id', $req->id);
        $brand->delete();

        return response()->json($brand);

    }

}
