<?php

namespace App\Http\Controllers;

use App\Models\ExternalOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExternalOrdersController extends Controller
{
    public function create (Request $req) {

        if ($req->id) :
            $externalOrders = ExternalOrders::find($req->id);
        else :
            $externalOrders = new ExternalOrders();
        endif;


        if($req->hasFile('image')) :

            $products = [];

            foreach ($req->file('image') as $key => $val) {
                $product = [
                    "image" => substr($val->store('public/ex-order'), 7),
                    "name" => $req->name[$key]
                ];
                $products[] = $product;
            }
            $externalOrders->products = $products;

        endif;

        $externalOrders->client_name = $req->client_name;
        $externalOrders->address     = $req->address;
        $externalOrders->phone_1     = $req->phone_1;
        $externalOrders->phone_2     = $req->phone_2;
        $externalOrders->status      = $req->status;
        $externalOrders->channel     = $req->channel;
        $externalOrders->nots        = $req->nots;
        $externalOrders->shipping_cost = $req->shipping_cost;
        $externalOrders->total       = $req->total;
        $externalOrders->order_num   = 1;

        $externalOrders->save();

        return response()->json($externalOrders);
    }

    public function image_design (Request $req) {

        $externalOrders = ExternalOrders::find($req->id);

        if($req->hasFile('image_design')) :

            $products = [];

            foreach ($req->file('image_design') as $key => $val) {
                $product = [
                    "image_design" => substr($val->store('public/ex-order'), 7),
                    "image" => $req->image[$key],
                    "name" => $req->name[$key]
                ];
                $products[] = $product;
            }
            $externalOrders->products = $products;

        endif;

            $externalOrders->total = $req->total;
            $externalOrders->shipping_cost = $req->shipping_cost;
            $externalOrders->save();

        return response()->json($externalOrders);
    }

    public function show ($status) {
        return response()->json(ExternalOrders::where('status', $status)->get());
    }


    public function updateStatus (Request $req) {
        $externalOrders = ExternalOrders::find($req->id);
        $externalOrders->status      = $req->status;
        $externalOrders->save();
        return response()->json($externalOrders);
    }

    public function delete ($id) {
        $externalOrders = ExternalOrders::find($id);
        foreach ($externalOrders->products as $val) {
            Storage::delete('public/' . $val['image']);
        }
        $externalOrders->delete();
        return response()->json($externalOrders);
    }
}
