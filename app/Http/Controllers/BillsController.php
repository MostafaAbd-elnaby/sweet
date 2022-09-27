<?php

namespace App\Http\Controllers;

use App\Events\createBill;
use App\Events\deleteBill;
use App\Events\editBill;
use App\Events\productTracking;
use App\Events\ProductTrackingBuy;
use App\Events\ProductTrackingSale;
use App\Models\bills;
use App\Models\branchs_products;
use App\Models\dailyRestrictions;
use App\Models\products;
use App\Models\products_traker;
use App\Models\trader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillsController extends Controller
{
    public function show ( Request $request)
    {
        return response()->json(bills::orderBy('id', 'desc')->get());
    }

    public function filter ( Request $req)
    {
        $bills = new bills();
        if ($req->total)    $bills = $bills->where('total', $req->total);
        if ($req->type)      $bills = $bills->where('type', $req->type);
        if ($req->bill_num)  $bills = $bills->where('bill_num', $req->bill_num);
        if ($req->branch)    $bills = $bills->where('branchs_id', $req->branch);
        if ($req->range)     $bills = $bills->whereBetween('created_at', [ $req->range['from'], $req->range['to'] ]);

        return response()->json($bills->orderBy('id', 'desc')->get());
    }

    public function create(Request $req) {

        // Begin Transaction To Save All Data
        // if there is any error no data will be inserted to database
        DB::beginTransaction();

        // checking for id value
        // if there is an id value we will consume that this request is for editing
        // else creation

        $id = $req->id ?? 0;
        if ($id) :
            $bill = bills::find($id);
            $bill_num = $bill->bill_num;
        else:
            $bill = new bills();
            $bill_num = ( bills::orderBy('id', 'DESC')->pluck('bill_num')->first() ) + 1;
        endif;

        $bill->bill_num   = $bill_num;
        $bill->user_id    = $req->user_id;
        $bill->user_type  = $req->user_type;
        $bill->branchs_id = $req->branchs_id;
        $bill->trader_id  = $req->trader_id;
        $bill->client_id  = $req->client_id;
        $bill->type       = $req->type;
        $bill->total      = $req->total;
        $bill->payed      = $req->payed;
        $bill->reast      = $req->reast;
        $bill->nots       = $req->nots;


        $dailyRestrictions = dailyRestrictions::where('bills_id', $bill->bill_num)->first();
        if ( $id && $dailyRestrictions  ) :
            /*
             * Return Stoke to default before update .
             */
            $this->beforeUpdate( $bill );
        endif;

        $bill->products   = $req->products;
        $bill->save();

        // If the request type is OFFER PRICE and status STORE we will abort the Events
        // else trigger the events

        if ( $req->type === "offer_price" ) {
            DB::commit();
            return response()->json($bill);
        }

        if ( $req->type === "sales_returns" ) {
            ///////////////////////////////////////////////////////
            //// Edit a Bill Event
            $this->sales_returns( $bill );
            DB::commit();
            return response()->json($bill);
            //////////////////////////////////////////////////////
        }

        if ( $req->type === "Returned_purchases" ) {
            ///////////////////////////////////////////////////////
            //// Edit a Bill Event
            $this->Returned_purchases( $bill );
            DB::commit();
            return response()->json($bill);
            //////////////////////////////////////////////////////
        }

        if ( $id && $dailyRestrictions  ) :
            ///////////////////////////////////////////////////////
            //// Edit a Bill Event
            event( new editBill($bill) );
            //////////////////////////////////////////////////////
        else:
            ///////////////////////////////////////////////////////
            //// Purchase a product Event
            event( new createBill($bill) );
            //////////////////////////////////////////////////////
        endif;

        if ( $req->type === "in" ) :
            //////////////////////////////////////////////////////////
            //// Product Tracking Event Buy
            event( new ProductTrackingBuy($bill) );
            ////////////////////////////////////////////////////////
        else:
            //////////////////////////////////////////////////////////
            //// Product Tracking Event Sale
            event( new ProductTrackingSale($bill) );
            ////////////////////////////////////////////////////////
        endif;

        DB::commit();
        return response()->json($bill);
    }

    public function delete(Request $req) {
        DB::beginTransaction();
            $bill = bills::find($req->id);
            $bill->delete();
            event(new deleteBill($bill));
        DB::commit();
        return response()->json($bill);
    }

    public function beforeUpdate( $bill )
    {
        collect($bill->products)->each(function ( $product ) use ($bill) {
            $item =  branchs_products::where(['products_id' => $product['id'], 'branchs_id' => $bill->branchs_id])->first();
            if ( $bill->type === "in" ) :
                $item->stoke = $item->stoke - $product['qut'];
            elseif ( $bill->type !== "in" && $bill->type !== "offer_price" ) :
                $item->stoke = $item->stoke + $product['qut'];
            endif;
            $item->update();
        });
    }

    public function Returned_purchases ($bill) {
        collect($bill->products)->each(function ( $product ) use ($bill) {
            DB::table('branchs_products')
                ->where(['products_id' => $product['id'], 'branchs_id' => $bill->branchs_id])
                ->decrement('stoke', $product['qut']);
            $products_traker = new products_traker();
            $products_traker->products_id = $product['id'];
            $products_traker->products_name = $product['name_ar'];
            $products_traker->description = 'مرتجع مشتريات';
            $products_traker->qut = $product['qut'];
            $products_traker->price = $product['purchasing_price'];
            $products_traker->bills_id = $bill->id;
            $products_traker->save();
        });

        if ($bill->trader_id) :
            $trader = trader::find($bill->trader_id);
                $trader->increment('debit', $bill->reast);
            $trader = trader::find($bill->trader_id);
            $trader->total =  abs($trader->creditor - $trader->debit);
            $trader->save();
        endif;

        $dailyRestrictions_count = dailyRestrictions::count();
        $total = $dailyRestrictions_count !== 0 ?
            dailyRestrictions::latest()->value('total') : 0;
        $daily_restrictions = new dailyRestrictions();
        $daily_restrictions->bills_id   = $bill->bill_num;
        $daily_restrictions->trader_id   = $bill->trader_id ?? null;

        $daily_restrictions->type        = "مرتجع مشتريات";
        $daily_restrictions->description = "أرجاع منتجات الي تاجر";
        $daily_restrictions->take_from     = $bill->payed;
        $daily_restrictions->put_to  = 0;
        $daily_restrictions->total      =  $total + $bill->payed;

        $daily_restrictions->save();

        return response()->json($bill);
    }

    public function sales_returns ($bill) {
        collect($bill->products)->each(function ( $product ) use ($bill) {
            DB::table('branchs_products')
                ->where(['products_id' => $product['id'], 'branchs_id' => $bill->branchs_id])->update([
                    'stoke' => DB::raw('stoke+'. $product['qut'])
                ]);
            products::find($product['id'])->update(['purchasing_price' => $product['purchasing_price']]);
            $products_traker = new products_traker();
            $products_traker->products_id = $product['id'];
            $products_traker->products_name = $product['name_ar'];
            $products_traker->description = 'مرتجع مبيعات';
            $products_traker->qut = $product['qut'];
            $products_traker->price = $product['price'];
            $products_traker->bills_id = $bill->id;
            $products_traker->save();
        });

        if ($bill->trader_id) :
            $trader = trader::find($bill->trader_id);
            $trader->increment('creditor', $bill->reast);
            $trader = trader::find($bill->trader_id);
            $trader->total =  abs($trader->creditor - $trader->debit);
            $trader->save();
        endif;

        $dailyRestrictions_count = dailyRestrictions::count();
        $total = $dailyRestrictions_count !== 0 ?
            dailyRestrictions::latest()->value('total') : 0;
        $daily_restrictions = new dailyRestrictions();
        $daily_restrictions->bills_id   = $bill->bill_num;
        $daily_restrictions->trader_id   = $bill->trader_id ?? null;

        $daily_restrictions->type        = "مرتجع مبيعات";
        $daily_restrictions->description = "أرجاع منتجات الي تاجر";
        $daily_restrictions->put_to     = $bill->payed;
        $daily_restrictions->take_from  = 0;
        $daily_restrictions->total      =  $total - $bill->payed;

        $daily_restrictions->save();

        return response()->json($bill);
    }

}
