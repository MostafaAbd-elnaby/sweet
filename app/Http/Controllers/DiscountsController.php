<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\discounts;

class DiscountsController extends Controller
{
    public function show ($id) {
        if ($id)
            return response()->json(discounts::where('staffs_id', $id)->orderBy('id', 'desc')->get());
        else
            return response()->json(discounts::orderBy('id', 'desc')->get());
    }

    public function createOrUpdate ( Request $req) {

        if ($req->id)
            $discounts = discounts::find($req->id);
        else
            $discounts = new discounts();

        $discounts->discount        = $req->discount;
        $discounts->staffs_id       = $req->staffs_id;
        $discounts->staffs_name       = $req->staffs_name;
        $discounts->created_by_id   = $req->created_by_id;
        $discounts->created_by_name = $req->created_by_name;
        $discounts->notes           = $req->notes;
        $discounts->save();

        return response()->json($discounts);
    }

    public function delete ( Request $req) {
        $discounts = discounts::whereIn('id', $req->id);
        $discounts->delete();
        return response()->json($discounts);
    }
}
