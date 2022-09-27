<?php

namespace App\Http\Controllers;

use App\Models\attending_leavins;
use App\Models\departments;
use App\Models\discounts;
use App\Models\holidays;
use App\Models\rewards;
use App\Models\staffs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class staffsController extends Controller
{
    public function test () {
        $role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit articles']);
        return response()->json([$permission,$role]);
    }

    public function report (Request $req) {
        $response = [];
        $rang = [$req->from, $req->to];
        $response['from']       = $req->from;
        $response['to']         = $req->to;
        $staffs                 = staffs::find($req->id);
        $response['stuff_info'] = $staffs;
        $response['department'] = $staffs->departments_id ? departments::find($staffs->departments_id)->name : [];
        $response['attendance'] = attending_leavins::where('staffs_id', $staffs->id)->whereBetween('day', $rang)->get();
        $response['holidays']   = holidays::where('staffs_id', $staffs->id)->whereBetween('holiday', $rang)->get();
        $response['discount']   = discounts::where('staffs_id', $staffs->id)->whereBetween('created_at', $rang)->get();
        $response['rewards']    = rewards::where('staffs_id', $staffs->id)->whereBetween('created_at', $rang)->get();
        $rewards  = collect($response['rewards'])->pluck('reward');
        $discount = collect($response['discount'])->pluck('discount');
        $discount = count($discount) ? $discount[0] : 0;
        $rewards = count($rewards) ? $rewards[0] : 0;
        $response['salary'] = $staffs->salary + $rewards - $discount;

        return response()->json($response);
    }

    public function showAll () {
        return response()->json(staffs::get());
    }

    public function showDropdone () {
        return response()->json(staffs::get(['id AS value', 'name As label']));
    }

    public function Findstaffs ( $id ) { return response()->json(staffs::find($id)); }

    public function Createstaffs ( Request $req ) {

        if ($req->id)
            $staffs = staffs::find($req->id);
        else
            $staffs = new staffs;

        if ($req->hasFile('img')) :
            $staffs->img ? Storage::delete('public/'.$staffs->img) : '';
            $staffs->img = substr($req->file('img')->store('public/seller'), 7);
        endif;

        if ( $req->password != "undefined" )
            $staffs->password = bcrypt($req->password);

        $staffs->name            = $req->name;
        $staffs->email           = $req->email;
        $staffs->phone           = $req->phone;
        $staffs->departments_id  = $req->departments_id ?? 0;
        $staffs->permission      = $req->permission;
        $staffs->branchs_id      = $req->branchs_id;
        $staffs->permission      = $req->permission;
        $staffs->salary          = $req->salary;
        $staffs->user_id         = $req->user_id;
        $staffs->job_title       = $req->job_title;

        $staffs->save();

        return response()->json($staffs);

    }

    public function Login ( Request $req ) {

        $validator = $req->validate ( [
            'email' => 'required',
            'password' => 'required'
        ] ) ;

        $credentials = $req->only('email', 'password');

        if (!Auth::guard('staffs')->attempt( $credentials ) ):

            return response([ 'login' => false, 'message' => 'Invalid login credentionls.', 'staffs' => $validator ]);

        endif;

        $staffs = Auth::guard('staffs')->user();

        return response( [ 'login' => true, 'user' => $staffs, 'tab' => $req->tab ] );

    }


    public function Delete ( $id ) {
        $staffs = staffs::find($id);
        if ($staffs->img != null)
            Storage::delete('public/'.$staffs->img);
        $staffs->delete();
        return response($staffs);
    }
}
