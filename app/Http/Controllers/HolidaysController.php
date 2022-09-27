<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\holidays;

class HolidaysController extends Controller
{

    public function show ($id) {
        if ($id):
            $holidays = holidays::where('staffs_id', $id)->orderBy('id', 'desc')->get();
        else:
            $holidays = holidays::orderBy('id', 'desc')->get();
        endif;

        $response['holidays'] = collect($holidays)->pluck('holiday');

        return response()->json($response);
    }
    public function showData ($id) {
        if ($id):
            $holidays = holidays::where('staffs_id', $id)->orderBy('id', 'desc')->get();
        else:
            $holidays = holidays::orderBy('id', 'desc')->get();
        endif;
        return response()->json($holidays);
    }

    public function createOrupdate( Request $req)
    {
        if ($req->id)
            $holidays = holidays::find($req->id);
        else
            $holidays = new holidays();

        $holidays->holiday         = $req->holiday;
        $holidays->discount        = $req->discount;
        $holidays->description     = $req->description;
        $holidays->discount        = $req->discount;
        $holidays->staffs_id       = $req->staffs_id;
        $holidays->staffs_name     = $req->staffs_name;
        $holidays->created_by_id   = $req->created_by_id;
        $holidays->created_by_name = $req->created_by_name;
        $holidays->save();

        return response()->json($holidays);
    }

    public function delete( Request $req)
    {
        $holidays = holidays::whereIn('id', $req->id);
        $holidays->delete();
        return response()->json($holidays);
    }
}
