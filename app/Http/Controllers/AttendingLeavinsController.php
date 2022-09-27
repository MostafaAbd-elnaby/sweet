<?php

namespace App\Http\Controllers;

use App\Models\attending_leavins;
use Illuminate\Http\Request;

class AttendingLeavinsController extends Controller
{
    public function show ($id) {
        if ($id)
            return response()->json(attending_leavins::where('staffs_id', $id)->orderBy('id', 'desc')->get());
        else
            return response()->json(attending_leavins::orderBy('id', 'desc')->get());
    }

    public function update ( Request $req) {

        $attending_leaving = attending_leavins::find($req->id);

        $attending_leaving->attend_time     = $req->attend_time;
        $attending_leaving->leave_time      = $req->leave_time;
        $attending_leaving->day             = $req->day;
        $attending_leaving->save();

        return response()->json($attending_leaving);
    }

    public function attendTime ( Request $req) {

        if ($req->id)
            $attending_leaving = attending_leavins::find($req->id);
        else
            $attending_leaving = new attending_leavins();

        $attending_leaving->staffs_id       = $req->staffs_id;
        $attending_leaving->staffs_name     = $req->staffs_name;
        $attending_leaving->created_by_id   = $req->created_by_id;
        $attending_leaving->created_by_name = $req->created_by_name;
        $attending_leaving->attend_time     = $req->attend_time;
        $attending_leaving->leave_time      = $req->leave_time;
        $attending_leaving->day             = $req->day;
        $attending_leaving->save();

        return response()->json($attending_leaving);
    }

    public function leaveTime ( Request $req) {

        if ($req->id)
            $attending_leaving = attending_leavins::find($req->id);
        else
            $attending_leaving = new attending_leavins();

        $attending_leaving->staffs_id       = $req->staffs_id;
        $attending_leaving->leave_time      = $req->leave_time;
        $attending_leaving->save();

        return response()->json($attending_leaving);
    }

    public function delete ( Request $req) {
        $attending_leaving = attending_leavins::whereIn('id', $req->id);
        $attending_leaving->delete();
        return response()->json($attending_leaving);
    }
}
