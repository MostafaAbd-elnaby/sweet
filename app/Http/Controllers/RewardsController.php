<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Models\rewards;

class RewardsController extends Controller
{
    public function show ($id) {
        if ($id)
            return response()->json(rewards::where('staffs_id' , $id)->orderBy('id', 'desc')->get());
        else
            return response()->json(rewards::orderBy('id', 'desc')->get());
    }

    public function createOrUpdate ( Request $req) {

        if ($req->id)
            $rewards = rewards::find($req->id);
        else
            $rewards = new rewards();

        $rewards->reward          = $req->reward;
        $rewards->staffs_id       = $req->staffs_id;
        $rewards->staffs_name     = $req->staffs_name;
        $rewards->created_by_id   = $req->created_by_id;
        $rewards->created_by_name = $req->created_by_name;
        $rewards->notes           = $req->notes;
        $rewards->save();

        return response()->json($rewards);
    }

    public function delete ( Request $req) {
        $rewards = rewards::whereIn('id', $req->id);
        $rewards->delete();
        return response()->json($rewards);
    }
}
