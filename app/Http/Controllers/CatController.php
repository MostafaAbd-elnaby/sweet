<?php

namespace App\Http\Controllers;

use App\Events\UpdateCategory;
use App\Models\cat;
use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatController extends Controller
{

    public function index()
    {
        $categories = cat::with('children')->whereNull('parent_id')->get();

        return response($categories);
    }

    public function showCatsInDropdownList()
    {
        return cat::select(['name_ar AS label', 'id AS value'])->get();
    }

    public function catsDropDownMohsen()
    {
        return cat::select(['name_ar', 'id'])->get();
    }

    public function store(Request $request)
    {


        $imgpath = 'defalt.png';
        if ($request->hasFile('img')) :
            $imgpath = substr($request->file('img')->store('public/category'), 7);
        endif;

        $cat            = new cat();
        $cat->name_ar   = $request->name_ar;
        $cat->name_en   = $request->name_en;
        $cat->parent_id = $request->parent_id;
        $cat->slug      = $request->name_ar;
        $cat->img       = $imgpath;
        $cat->save();

        return response(['msg' => 'You have successfully created a Category!']);
    }

    public function update(Request $req)
    {
        $catParent = cat::find($req->id);

        $catParent->name_ar = $req->name_ar;
        $catParent->name_en = $req->name_en;
        $catParent->slug    = Str::slug($req->name_en, '-');
        if ($req->hasFile('img')) :
            if ($catParent->img)
                Storage::delete('public/' . $catParent->img);
            $catParent->img = substr($req->file('img')->store('public/category'), 7);
        endif;
        $catParent->save();

        foreach (json_decode($req->children, true) as $key =>  $val) {

            if (isset($val['name_ar']) || isset($val['name_en'])) :
                $catCild = cat::find($val['id']);
                if ($req->hasFile('childrenImage') && isset($req->file('childrenImage')[$key])) :
                    if ($catCild->img)
                        Storage::delete('public/' . $catCild->img);
                    $catCild->img = substr($req->file('childrenImage')[$key]->store('public/category'), 7);
                endif;
                $catCild->name_ar = $val['name_ar'];
                $catCild->name_en = $val['name_en'];
                $catCild->save();

            else:
                $catCild = cat::find($val['id']);
                $catCild->delete();
            endif;

        }
        return response('ok');
    }

    public function delete($id)
    {
        $cat = cat::find($id);

        $childern = cat::where('parent_id', $id)->get();

        foreach ($childern as $val) {
            $child = cat::find($val->id);
            $child->parent_id = null;
            $child->save();
        }
        $cat->delete();
        return response(['zsd' => $childern]);
    }


}
