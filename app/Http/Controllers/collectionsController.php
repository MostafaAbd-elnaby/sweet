<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\collections;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\collections as collectionsResorce;
class collectionsController extends Controller
{

//    public function Home (request $req) {
//        $Collections = collections::with("products")->where('is_home', 1)->get();
//        return response()->json($Collections);
//    }

//    public function products (request $req) {
//        $Collections = collections::with([ "products" => function ($query) {
//            $query->select( [ "products.id", "name_ar", "price_3", "writer_id", "img" ] );
//        } ])->where('is_home', 0)->get();
//        return response()->json($Collections);
//    }

    public function getSingelCollections ($id) {
        $Collections = collections::where('id', $id)->with( "products")->get();
        return response()->json($Collections);
    }

    public function productsForCreateCollectionsDash()
    {
        return response(products::select('id', 'name_en', 'name_ar', 'img')->get());
    }

    public function collections()
    {
        $collections = collect(collections::with('products')->get());
        $collections = $collections->map( function ($val) {
           return [
             "id" => $val['id'],
             "name_en" => $val['name_en'],
             "slug" => $val['slug'],
             "name_ar" => $val['name_ar'],
             "image" => $val['image'],
             "is_ads" => $val['is_ads'],
             "is_home" => $val['is_home'],
             "count" => count($val['products']),
             "products" => $val['is_home'] ? $val['products'] : [],
           ];
        });
        return response($collections);
    }

    public function getCollectionWithProductsViewForDash()
    {
        return response(collections::with('products')->get());
    }

    public function CreatCollections(Request $req)
    {

        $Collections = new collections;

        $imgpath = 'defalt.png';
        if ($req->hasFile('image')) :
            $imgpath = substr($req->file('image')->store('public/collections'), 7);
        endif;

        $Collections->name_ar = $req->name_ar;
        $Collections->name_en = $req->name_en;
        $Collections->image   = $imgpath;
        $Collections->slug    = $req->name_ar;
        $Collections->is_home = $req->is_home;
        $Collections->is_ads = $req->is_ads;

        $Collections->save();

        $productsId = collect(json_decode($req->products))->pluck('value');

        $products = products::find($productsId);
        $Collections->products()->syncWithoutDetaching($products);

        return response($Collections->with( 'products' )->where('id', '=',$Collections->id)->get());
    }

    public function EditCollections(Request $req)
    {
        $Collections = collections::find($req->id);

        if ($req->hasFile('image')) :
            $Collections->image = substr($req->file('image')->store('public/collections'), 7);
        endif;

        $Collections->name_ar = $req->name_ar;
        $Collections->name_en = $req->name_en;
        $Collections->slug    = $req->name_ar ;
        $Collections->is_home = $req->is_home ;
        $Collections->is_ads  = $req->is_ads ;
        $Collections->save();
        $productsId = [];

        foreach (json_decode($req->products) as $val) {
            $productsId[] = $val->id;
        }

        $products = products::find($productsId);
        $Collections->products()->sync($products);

        // return response($Collections->with( 'products' )->where('id', '=',$Collections->id)->get());
    }

        public function deleteCollections ( $id ) {

        $Collections = collections::find($id) ;
        $Collections->products()->detach();
        $Collections->delete();
        return response(collections::with('products')->get());

    }

    public function is_home ( Request $req ) {

        $Collections = collections::find($req->id) ;
        $Collections->is_home = $req->is_home;
        $Collections->save();
        return response(collections::with('products')->get());

    }

}
