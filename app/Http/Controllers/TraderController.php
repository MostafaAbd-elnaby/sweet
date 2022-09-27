<?php

namespace App\Http\Controllers;

use App\Events\PurchaseProduct;
use App\Models\bills;
use App\Models\credit_and_debit_notes;
use App\Models\dailyRestrictions;
use App\Models\history_traders;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\trader;

class TraderController extends Controller
{
    public function show () {
        return response()->json(trader::get());
    }

    public function transferShow () {
        return response()->json(trader::select('name AS label', 'id AS value', 'debit', 'creditor', 'total')->get());
    }

    public function transfer ( Request $req ) {
        $traderTo = trader::find($req->traderTo['value']);

            $traderTo->creditor = $req->traderTo['creditor'];
            $traderTo->debit = $req->traderTo['debit'];
            $traderTo->total = $req->traderTo['total'];

        $traderTo->save();

        $desc = "to" ;
        $this->addHistory_traders($traderTo->id, $desc, null, $req->traderTo['label'], $req->amount, $req->transformType, $req->created_by_id, $req->created_by_name);

        $traderFrom = trader::find($req->traderFrom['value']);

            $traderFrom->creditor = $req->traderFrom['creditor'];
            $traderFrom->debit = $req->traderFrom['debit'];
            $traderFrom->total = $req->traderFrom['total'];

        $traderFrom->save();

        $desc = "from" ;
        $this->addHistory_traders($traderFrom->id, $desc, $req->traderFrom['label'], null, $req->amount, $req->transformType, $req->created_by_id, $req->created_by_name);

        return response()->json([$traderFrom, $traderTo]);
    }

    public function addHistory_traders ($id, $desc, $transfer_from, $transfer_to, $amount, $transformType, $created_id, $created_name) {
        $history = new history_traders();

        $history->trader_id       = $id;
        $history->description     = $desc;
        $history->transfer_to     = $transfer_to;
        $history->transfer_from   = $transfer_from;
        $history->amount          = $amount;
        $history->transformType   = $transformType;
        $history->created_by_id   = $created_id;
        $history->created_by_name = $created_name;
        $history->save();
        return $history;
    }

    public function Account_statement ( Request $req ) {

        $bills = bills::where('trader_id', $req->trader_id)
            ->whereBetween('created_at', [ $req->dataRange['from'], $req->dataRange['to'] ])
            ->get()->toArray();

        $dailyRestrictions = dailyRestrictions::where('trader_id', $req->trader_id)
            ->whereBetween('created_at', [ $req->dataRange['from'], $req->dataRange['to'] ])
            ->where('bills_id', 0)
            ->get()->toArray();

        $history = history_traders::where('trader_id', $req->trader_id)
            ->whereBetween('created_at', [ $req->dataRange['from'], $req->dataRange['to'] ])
            ->get()->toArray();

        $credit_and_debit_notes = credit_and_debit_notes::where('trader_id', $req->trader_id)
            ->whereBetween('created_at', [ $req->dataRange['from'], $req->dataRange['to'] ])
            ->get()->toArray();

        $data = array_merge($bills, $dailyRestrictions);
        $data = array_merge($data, $history);
        $data = array_merge($data, $credit_and_debit_notes);

        usort($data, function($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });

        return response()->json($data);
    }

    public function create ( Request $req ) {
        if ( $req->id )
            $trader = trader::find($req->id);
        else
            $trader = new trader();

        $trader->name     = $req->name;
        $trader->address  = $req->address;
        $trader->phone    = $req->phone;
        $trader->debit    = $req->debit;
        $trader->creditor = $req->creditor;
        $trader->total =  abs($req->creditor - $req->debit );

        $trader->save();

        return response()->json( $trader );
    }

    public function delete ( $id ) {
        $trader = trader::find( $id );
        $trader->delete();
        return response()->json( $trader );
    }
}
