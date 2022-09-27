<?php

namespace App\Http\Controllers;

use App\Models\offers;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function show () {
        return response()->json(offers::get());
    }

    public function showList () {
        return response()->json(offers::get(['id AS value', 'name As label']));
    }

    public function CreateOrUpdate ( Request $req ) {

        $isNotExssitOffers = offers::where('email', $req->code)->first();
        if ($isNotExssitOffers)
            return response()->json(['email' => true]);

        if ($req->id)
            $offers = offers::find($req->id);
        else
            $offers = new offers();

        $offers->start_date = $req->start_date;
        $offers->type_value = $req->type_value;
        $offers->type_name  = $req->type_name;
        $offers->end_date   = $req->end_date;
        $offers->value      = $req->value;
        $offers->name       = $req->name;
        $offers->code       = $req->code;
        $offers->save();

        return response()->json($offers);
    }

    public function delete ( Request $req ) {

        $offers = offers::whereIn('id', $req->id);
        $offers->delete();

        return response()->json($offers);

    }
}
