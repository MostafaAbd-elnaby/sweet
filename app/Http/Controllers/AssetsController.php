<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\assets;

class AssetsController extends Controller
{
    public function show () {
        return response()->json(assets::orderBy('id', 'desc')->get());
    }

    public function createOrUpdate ( Request $req) {

        if ($req->id)
            $assets = assets::find($req->id);
        else
            $assets = new assets();

        $assets->name            = $req->name;
        $assets->description     = $req->description;
        $assets->cost            = $req->cost;
        $assets->end_date        = $req->end_date;
        $assets->created_by_id   = $req->created_by_id;
        $assets->created_by_name = $req->created_by_name;
        $assets->save();

        return response()->json($assets);
    }

    public function delete ( Request $req) {
        $assets = assets::whereIn('id', $req->id);
        $assets->delete();
        return response()->json($assets);
    }
}
