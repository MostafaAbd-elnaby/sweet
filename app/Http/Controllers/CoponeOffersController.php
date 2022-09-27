<?php

namespace App\Http\Controllers;

use App\Models\copone_offers;
use App\Models\products;
use Illuminate\Http\Request;

class CoponeOffersController extends Controller
{
    public function showOffre_Copone ( Request $req ) {
        $copone = copone_offers::get();
        return response()->json($copone);
    }

    public function createOrUpdateOffreOrCopone ( Request $req ) {


        if ( $req->id ) :
            $copone = copone_offers::find($req->id);
        else :
            $copone = new copone_offers();
        endif;

        if (($req->id && $req->code !==  $copone->code) || !$req->id):
            $req->validate([
                'code' => 'unique:copone_offers,code',
            ]);
        endif;

        $copone->name     = $req->name;
        $copone->code     = $req->code;
        $copone->cost     = $req->cost;
        $copone->type     = $req->type;
        $copone->capacity = $req->capacity;
        $copone->end_date = $req->end_date;

        $copone->save();
        if ( $req->id ) :
            collect($req->removePrducts)->map( function ($product) {
                products::where('id', $product['id'])
                    ->update(['copone_offers' => 0]);
            });
        endif;
        collect($req->products)->map( function ($product) use($copone) {
            if ($copone->type === 'offer') {
                products::where('id', $product['id'])
                    ->update(['copone_offers' => $copone->id]);
            }
        });

        return response()->json(copone_offers::find($copone->id));
    }

    public function checkCoupon (Request $req) {
        return response()->json(copone_offers::where('code', $req->code)
            ->where('capacity' ,'>', 0)
            ->first());
    }

    public function delete ( $id ) {
        $copone = copone_offers::find($id);
        $copone->delete();
        return response()->json($copone);
    }
}
