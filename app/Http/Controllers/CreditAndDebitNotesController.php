<?php

namespace App\Http\Controllers;

use App\Models\credit_and_debit_notes;
use App\Models\trader;
use Illuminate\Http\Request;

class CreditAndDebitNotesController extends Controller
{

    public function showAll () {
        return response()->json(credit_and_debit_notes::paginate(20));
    }

    public function showForTrader ($id) {
        return response()->json(credit_and_debit_notes::where('trader_id', $id)->paginate(20));
    }

    public function createCredit (Request $req) {

        $credit = new credit_and_debit_notes();

        $credit->trader_id       = $req->trader_id;
        $credit->trader_name       = $req->trader_name;
        $credit->created_by_id   = $req->created_by_id;
        $credit->created_by_name = $req->created_by_name;
        $credit->title           = $req->title;
        $credit->body            = $req->body;
        $credit->type            = $req->type;
        $credit->amount          = $req->amount;
        $credit->save();

            $trader = trader::find($credit->trader_id);
        if ($credit->type === 'دائن')
            $trader->decrement('creditor', $credit->amount);
        else
            $trader->decrement('debit', $credit->amount);
        $trader->save();

        return response()->json($trader);

    }

    public function delete ($id) {
        $credit_and_debit_notes = credit_and_debit_notes::find($id);
        $credit_and_debit_notes->delete();

        $trader = trader::find($credit_and_debit_notes->trader_id);
        if ($credit_and_debit_notes->type === 'دائن')
            $trader->increment('creditor', $credit_and_debit_notes->amount);
        else
            $trader->increment('debit', $credit_and_debit_notes->amount);
        $trader->save();

        return response()->json();
    }

}
