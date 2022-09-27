<?php

namespace App\Http\Controllers;

use App\Models\assets;
use App\Models\branchs;
use App\Models\dailyRestrictions;
use App\Models\products;
use App\Models\trader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dailyRestrictionsController extends Controller
{
    public function show()
    {
        return dailyRestrictions::orderBy( 'id' , 'desc' )->get();
    }

    public function capital()
    {
        $capital = [];
        $branchs = collect(branchs::get())->map(function ($val, $key) {
            $total = 0;
            $branchs_products = DB::table('branchs_products')->where(["branchs_id" => $val['id']]);
            foreach ($branchs_products->get() AS $valBranch) {
                $product = products::select('purchasing_price')->find($valBranch->products_id);
                $total += ($product->purchasing_price ?? 0) * $valBranch->stoke;
            }
            return
                [
                    "name"            => $val['name_ar'],
                    "productCount"    => $branchs_products->count(),
                    "totalStokeCount" => $branchs_products->sum('stoke'),
                    "totalPrice"      => $total,
                ];
        });

        $calcTotal = collect($branchs);

        $capital['branchs']['info']  = $branchs;

        $capital['branchs']['total'] = [
           "productCount"    => $calcTotal->sum('productCount'),
           "totalStokeCount" => $calcTotal->sum('totalStokeCount'),
           "totalPrice"      => $calcTotal->sum('totalPrice'),
        ];

        $traders = collect(trader::get());
        $capital['traders']['info'] = [
            "tradersCount" => $traders->count(),
            "tradersDebit" => $traders->sum('debit'),
            "tradersCreditor" => $traders->sum('creditor'),
        ];
        $dailyRestrictionsTotal = dailyRestrictions::latest('id')->first();
        $capital['dailyRestrictions'] = $dailyRestrictionsTotal ? $dailyRestrictionsTotal->total : 0;

        $total = $capital['branchs']['total']['totalPrice'];
        $dailyRestrictions = $capital['dailyRestrictions'];

        $creditor = $traders->sum('creditor');
        $debit = $traders->sum('debit');

        $assets = collect(assets::get())->sum('cost');
        $capital['Assets'] = $assets;
        $capital['capital'] = (int)$total + (int)$dailyRestrictions + (int)$assets + (int)$creditor - (int)$debit;
       return response()->json($capital);
    }

    public function filter( Request $req )
    {
        $bills = new dailyRestrictions();
        if ( $req->type ) $bills = $bills->where( 'type' , $req->type );
        if ( $req->range ) $bills = $bills->whereBetween( 'created_at' , [ $req->range[ 'from' ] , $req->range[ 'to' ] ] );

        return response()->json( $bills->orderBy( 'id' , 'desc' )->get() );
    }

    public function add( Request $req )
    {
        $dailyRestrictions = new dailyRestrictions();
        $dailyRestrictions_count = dailyRestrictions::count();
        $total = $dailyRestrictions_count !== 0 ?
            dailyRestrictions::latest()->value('total') : 0;

        if ($req->trader_id)
            $dailyRestrictions->trader_id  = $req->trader_id;

        $dailyRestrictions->type        = $req->type;
        $dailyRestrictions->description = $req->description;
        if ($req->creationType === 'take_from') {
            $dailyRestrictions->take_from = $req->take_from;
            $dailyRestrictions->total     = $total + $req->take_from;
        } else {
            $dailyRestrictions->put_to = $req->put_to;
            $dailyRestrictions->total  =  $total - $req->put_to;
        }
        $dailyRestrictions->save();

        return response()->json( $dailyRestrictions );
    }

    public function edit_trader( Request $req )
    {
        $dailyRestrictions = new dailyRestrictions();
        $dailyRestrictions_count = dailyRestrictions::count();
        $total = $dailyRestrictions_count !== 0 ?
            dailyRestrictions::latest()->value('total') : 0;

        $dailyRestrictions->type        = $req->type;
        $dailyRestrictions->description = $req->description;

        $trader = trader::find($req->trader_id);

        $dailyRestrictions->trader_id  = $trader->id;

        if ($req->creationType === 'take_from') {

            $dailyRestrictions->take_from = $req->take_from;
            $dailyRestrictions->total     = $total + $req->take_from;

            $trader->debit = $trader->debit - $req->take_from;
        } else {
            $dailyRestrictions->put_to = $req->put_to;
            $dailyRestrictions->total  =  $total - $req->put_to;

            $trader->creditor =  $trader->creditor - $req->put_to;
        }

        $dailyRestrictions->save();
        $trader->total =  abs($trader->creditor - $trader->debit);
        $trader->save();

        return response()->json( $trader );
    }

    function delete (Request $req) {
        $dailyRestrictions = dailyRestrictions::find($req->id);
        $dailyRestrictions->delete();
        return response()->json( $dailyRestrictions );
    }
}
