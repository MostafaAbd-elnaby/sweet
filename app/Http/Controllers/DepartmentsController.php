<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{

    public function show () {
        return response()->json(departments::orderBy('id', 'desc')->get());
    }

    public function showDropdown () {
        return response()->json(departments::orderBy('id', 'desc')->get(['id AS value', 'name AS label']));
    }

    public function createOrUpdate ( Request $req) {

        if ($req->id)
            $departments = departments::find($req->id);
        else
            $departments = new departments();

        $departments->name            = $req->name;
        $departments->count           = 0;
        $departments->created_by_id   = $req->created_by_id;
        $departments->created_by_name = $req->created_by_name;
        $departments->save();

        return response()->json($departments);
    }

    public function delete ( Request $req) {
        $departments = departments::whereIn('id', $req->id);
        $departments->delete();
        return response()->json($departments);
    }
}
