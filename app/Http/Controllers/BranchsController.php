<?php

namespace App\Http\Controllers;

use App\Events\ProductTrackingTransform;
use App\Models\branchs;
use App\Models\products;
use App\Models\products_traker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchsController extends Controller
{
    public function show(Request $req) {
        $branchs = branchs::all();
        return response()->json($branchs);
    }

    public function create(Request $req) {

        if ($req->id)
            $branchs = branchs::find($req->id);
        else
            $branchs = new branchs();

        $branchs->name_ar  = $req->name_ar;
        $branchs->name_en  = $req->name_en;
        $branchs->url      = $req->url;
        $branchs->location = $req->location;
        $branchs->save();

        return response()->json($branchs);
    }

    public function trnasfer(Request $req) {
        foreach ($req->productsToTransfer as $val) {
            DB::table('branchs_products')->where(["branchs_id" => $req->branchFrom, "products_id" => $val['value']])->decrement('stoke', $val['trnasferQut']);
           $item = DB::table('branchs_products')->where(["branchs_id" => $req->branchTo, "products_id" => $val['value']])->increment('stoke', $val['trnasferQut']);
            if (!$item){
                DB::table('branchs_products')->insert([
                    "branchs_id" => $req->branchTo,
                    "products_id" => $val['value'],
                    "stoke" => $val['trnasferQut']
                ]);
            }
            $this->ProductTrackingTransform($val, $req);
        }
        //////////////////////////////////////////////////////////
        //// Product Tracking Event Sale
//        event( new ProductTrackingTransform($bill) );
        ////////////////////////////////////////////////////////
        return response()->json();
    }

    public function ProductTrackingTransform($val, $req) {
        $products = products::find($val['value']);

        $branchFrom  = branchs::find($req->branchFrom);
        $branchTo    = branchs::find($req->branchTo);
        $description = 'تحويل من فرع ' . $branchFrom->name_ar . ' الي فرع ' . $branchTo->name_ar;

        $products_traker = new products_traker();
        $products_traker->products_id = $val['value'];
        $products_traker->products_name = $val['label'];
        $products_traker->description = $description;
        $products_traker->qut = $val['trnasferQut'];
        $products_traker->price = null;
        $products_traker->bills_id = null;
        $products_traker->save();
    }

    public function delete(Request $req) {
        $branchs = branchs::find($req->id);
        $branchs->delete();
        return response()->json($branchs);
    }
}
