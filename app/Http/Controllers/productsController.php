<?php

namespace App\Http\Controllers;

use App\Exports\products_trakerExport;
use App\Models\brand;
use App\Models\collections;
use App\Models\products;
use App\Models\cat;
use App\Models\products_commintes;
use App\Models\products_traker;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use App\Models\branchs;
use App\Models\presnters;
use App\Models\publishers;
use App\Models\translators;
use App\Models\writers;

class productsController extends Controller
{

    public function product ( $id ) {
        $product = products::with('brand')->find($id);
        return response()->json($product);
    }

    public function show (Request $req)
    {
        $products = products::with('brand');
        if ( $req->branch_id ) :
            $ids = DB::table( 'branchs_products' )->where( 'branchs_id', $req->branch_id )->get( 'products_id' )->pluck( 'products_id' );
            if ( $ids ) return response()->json($products->whereIn( 'id', $ids )->orderBy('id', 'desc')->paginate(12));
            else
                 return response()->json( $ids );
        endif;
        if ($req->name)
            return products::with('brand')->where('name_ar', 'like' ,"%{$req->name}%")->orderBy('id', 'desc')->paginate(12);

        return response()->json($products->orderBy('id', 'desc')->paginate(10000));
    }

    public function stokeRange (Request $req) {
           $ids = DB::table( 'branchs_products' )->where( 'branchs_id', $req->branch_id )->whereBetween('stoke', [$req->min, $req->max])->get( 'products_id' )->pluck( 'products_id' );
            if ( $ids )
                return response()->json(products::active()->whereIn( 'id', $ids )->orderBy('id', 'desc')->paginate(12));

    }

    public function showWhereBranch ($id) {
        $products = branchs::with(['products' => function ($query) {
            $query->select('name_ar', 'products.id');
        }])->where('id', $id)->first()->products->map(function ($val) {
            return [
                "label" => $val['name_ar'],
                "value" => $val['id'],
                "branchs" => $val['branchs'],
                "trnasferQut" => 0
            ];
        });
        return response()->json($products);
    }

    public function search (Request $req) {
        if ($req->search == 'true') :
            $products = (new products())->active();

            if ($req->name_ar) $products = $products->where('name_ar', 'like', "%{$req->name_ar}%");

            if ($req->name_en) $products = $products->where('name_en', 'like', "%{$req->name_en}%");

            if ($req->price) {
                $price = explode(',', $req->price);
                $products = $products->whereBetween('price', [ $price[0], $price[1] ]);
            }

            if ($req->is_printable) $products = $products->where('is_printable', 1);

            if ($req->size) {
                $products = $products->whereJsonContains('sizes', $req->size );
            }

            if ($req->color) {
                $products = $products->whereJsonContains('colors', [["name" => str_replace('_', ' ', $req->color) ]]);
            }

            if ($req->category) {
                $cat = cat::where('slug', $req->category)->first();
                $ids = DB::table('cat_products')->where('cat_id', $cat->id)->get('products_id')->pluck('products_id');
                $products = $products->whereIn('id', count($ids) !== 0 ? $ids : [] );
            }

            if ($req->hard_copy_branch) {
                $ids = DB::table('branchs_products')->where('branchs_id', $req->hard_copy_branch)->get('products_id')->pluck('products_id');
                $products = $products->whereIn('id', $ids);
            }

            if ($req->catId) {
                $ids = DB::table('cat_products')->where('cat_id', $req->catId)->get('products_id')->pluck('products_id');
                $products = $products->whereIn('id', $ids);
            }

            if ($req->collection) {
                $collection = collections::where('slug', $req->collection)->first();
                $ids = DB::table('collections_products')->where('collections_id', $collection->id)->get('products_id')->pluck('products_id');
                $products = $products->whereIn('id', $ids);
            }

            if ($req->brandId) {
                $ids = DB::table('brand_products')->where('brand_id', $req->brandId)->get('products_id')->pluck('products_id');
                $products = $products->whereIn('id', $ids);
            }

            if ($req->brand) {
                $brand = brand::where('name', $req->brand)->first();
                $ids = DB::table('brand_products')->where('brand_id', $brand->id)->get('products_id')->pluck('products_id');
                $products = $products->whereIn('id', $ids);
            }

            $response = $products->orderBy('id', 'desc')->paginate(12);
        else :
            $response = products::active()->orderBy('id', 'desc')->paginate(12);
        endif;
        if ($req->dash == 'true')
            return response()->json($response);
        else
            return response()->json(['products' => $response, 'filter' => $this->getFilterData()]);
    }

    public function getShopPrintProduct () {
        $lumise = DB::connection('lumise');
        $response = $lumise->table('lumise_products')
            ->select(['id', 'name', 'price', 'thumbnail_url', 'description', 'printings'])
            ->where('active', '1')
            ->get();
        $response = collect($response)->map(function ($product) use($lumise) {
            $design = $lumise->table('lumise_order_products')
                ->where('product_id', $product->id)
                ->select(['screenshots', 'cart_id'])
                ->get();
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'thumbnail_url' => $product->thumbnail_url,
                'description' => $product->description,
                'printings' => $product->printings,
                'design' => collect($design)->map( function ($item) {
                    return [
                        'screenshots' => json_decode($item->screenshots, true),
                        'cart_id' => $item->cart_id
                    ];
                }),
            ];
        })->toArray();
        return response()->json($response);
    }

    public function getFilterData () {
        $filter = [];
        $product = collect(products::get(['colors', 'sizes']));
        $filter['sizes'] = array_unique(call_user_func_array('array_merge', $product->pluck('sizes')->toArray()));
        $colors = $product->pluck('colors')->toArray();

        $filter['colors'] = array_unique(collect(call_user_func_array('array_merge', $colors))->pluck('color', 'name')->toArray());
        $filter['brands'] = brand::get(['name', 'img']);
        $filter['collection'] = collections::get(['name_en', 'slug']);
        return $filter;

    }

    public function searchName (Request $req) {
        if($req->name){
            $products = products::active()->select(['id', 'name_ar AS title', 'img AS image'])->where('name_ar', 'like', "%{$req->name}%")->get();
            return response()->json($products);
        }
        return [];
    }

    public function dorpdownlists () {

        $branchs    = branchs    ::select(['name_ar AS label', 'id AS value'])->orderBy('id', 'desc')->get();
        $cat        = cat        ::select(['name_ar AS label', 'id AS value'])->orderBy('id', 'desc')->get();
        $brand      = brand      ::select(['name AS label', 'id AS value'])->orderBy('id', 'desc')->get();

        return response()->json([
            'cat'        => [
                'options'    => $cat,
                'label'      => 'الأقسام',
                'key'        => 'catId',
                'model'      => [],
                'type'       => true
            ],
            'brands'    => [
                'options'    => $brand,
                'label'      => 'العلامة التجارية',
                'key'        => 'brandId',
                'model'      => [],
                'type'       => true
            ],
            'hard_copy_branch'    => [
                'options'    => $branchs,
                'label'      => 'الفروع',
                'key'        => 'hard_copy_branch',
                'model'      => [],
                'type'       => true
            ],
            /*
             * This index is only to avoid an error in front end in select option.
             */
            'model'    => [
            'options'    => 'This index is only to avoid an error in front end in select option.',
            'label'      => 'This index is only to avoid an error in front end in select option.',
            'key'        => 'This index is only to avoid an error in front end in select option.',
            'model'      => [],
            'type'       => false
            ],
        ]);
    }

    public function updateDorpdownlists ($tableName) {

        $responseData = '';

        if ($tableName === 'cat')
            $responseData = cat::select(['name_ar AS label', 'id AS value'])->latest('id')->first();

        if ($tableName === 'hard_copy_branch')
            $responseData = branchs::select(['name_ar AS label', 'id AS value'])->latest('id')->first();

        if ($tableName === 'brands')
            $responseData = brand::select(['name AS label', 'id AS value'])->latest('id')->first();

        return response()->json($responseData);
    }

    public function  createProduct (Request $req) {

        if ($req->id)
            $products = products::find($req->id);
        else
            $products = new products();

        if ($req->hasFile('img')) :
            if($products->img)
                Storage::delete('public/' . $products->img);
            $products->img = substr($req->file('img')->store('public/product'), 7);
        endif;

        if($req->hasFile('imgs')) :

            $imgs = [];

            if($products->imgs) :
                foreach (json_decode($products->imgs) as $val) {
                    Storage::delete('public/' . $val);
                }
            endif;

            foreach ($req->file('imgs') as $val) {
                $imgs[] = substr($val->store('public/product'), 7);
            }
            $products->imgs = json_encode($imgs);

        endif;

        $Colors = json_decode($req->colors, true);
        if($req->hasFile('imageColor')) :


            if($products->colors) :
                foreach ($products->colors as $val) {
                    Storage::delete('public/' . $val['img']);
                }
            endif;

            foreach ($req->file('imageColor') as $key => $val) {
                $Colors[$key]['img'] = substr($val->store('public/product'), 7);
            }

        endif;
        $products->colors = $Colors;

        $products->name_ar       = $req->name_ar;
        $products->name_en       = $req->name_en;
        $products->desc_ar       = $req->desc_ar;
        $products->desc_en       = $req->desc_en;
        $products->small_desc_en = $req->small_desc_en;
        $products->small_desc_ar = $req->small_desc_ar;
        $products->vido          = $req->vido;
        $products->lsbn          = $req->lsbn ?? 0;
        $products->price         = $req->price;
        $products->price_2       = $req->price_2 === 'null' ? 0 : $req->price_2;
        $products->purchasing_price = $req->purchasing_price === 'null' ? 0 : $req->purchasing_price;

        $products->sizes         = json_decode($req->sizes);
        $products->weight        = json_decode($req->weight);
        $products->volume        = json_decode($req->volume);

        $products->seo_title     = $req->seo_title ?? 0;
        $products->seo_desc      = $req->seo_desc ?? 0;
        $products->keywords      = $req->keywords ?? 0;
        $products->active        = $req->active;


        $products->save();


        if ( $req->user_type === 'Stuff' ) :
            $hard_copy_branch = json_decode($req->hard_copy_branch, true);
            DB::table('branchs_products')->updateOrInsert(
                ["id" => $hard_copy_branch['id'] ??null ],
                [
                "products_id" => $products->id ?? 0,
                "branchs_id"  => $hard_copy_branch['value']??null,
                "stoke"       => $hard_copy_branch['stoke']?? null,
            ]);
        else :
            collect( json_decode( $req->hard_copy_branch, TRUE ) )->each( function ( $val ) use ( $products ) {
                DB::table( 'branchs_products' )->updateOrInsert(
                    [ "id" => $val[ 'id' ] ??null ],
                    [
                        "products_id" => $products->id,
                        "branchs_id"  => $val[ 'value' ],
                        "stoke"       => $val[ 'stoke' ] ?? 0,
                    ] );
            } );
        endif;
        $cat     = cat::find(collect(json_decode($req->catId, true))->pluck('value'));
        $products->cat()->sync($cat);
        $brand     = brand::find(collect(json_decode($req->brand_id, true))->pluck('value'));
        $products->brand()->sync($brand);
        return response()->json($products);

    }

    public function updatePrice (Request $req) {

        $product = products::find($req->id)->update([$req->name => $req->new]);
        return response()->json(products::find($req->id));
    }

    public function activation (Request $req) {
        $product = products::find($req->id);
        $product->active = $req->active ;
        $product->save();
        return response()->json($product);
    }

    public function fileImport(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('productsImport')->store('public/temp'));
        $products = products::orderBy('id', 'desc')->paginate(12);
        return response()->json($products);
    }

    public function fileExport($data)
    {
        set_time_limit(10000);
        $ColumnNams = [];
        foreach (json_decode($data, true) as $col) {
            if ($col['value'])
                array_push($ColumnNams, $col['label']);
        }
        $Products = Products::get($ColumnNams)->toArray();
        return Excel::download(new ProductsExport($ColumnNams, $Products), 'Products-collection.xlsx');
    }

    public function fileExportProductTraking( $id )
    {
        set_time_limit(10000);
        return Excel::download(new products_trakerExport($id), 'Products-tracker.xlsx');
    }

    public function getColumnNams()
    {
        $productsColName = collect(Schema::getColumnListing('products'));
        return $productsColName->map(function ($val) {
           return  [
               "label" => $val,
                "value" => true
           ];
        });
    }

    public function productTrakers($id)
    {
        $products_traker = products_traker::where('products_id', $id)->paginate(20);
        return response()->json($products_traker);
    }

    public function delete ($id) {

        $products = products::find($id);
        Storage::delete('public/' . $products->img);
        if ($products->imgs) {
            foreach (json_decode($products->imgs) as $val) {
                Storage::delete('public/' . $val);
            }
        }
        $products->cat()->sync(0);
        $products->delete();
        return response()->json($products);
    }

    /*
     *
     * Comments
     *
     */

    /*
     * Show product Comments .
     */
    public function ProductComments ($id) {
        $Comments  = products_commintes::where('product_id', $id)->orderBy('id', 'DESC')->paginate(10);
        return response()->json($Comments);
    }

    /*
    * Create user Comments.
    */
    public function createOrUpdateProductsComments (Request $req) {
        if ($req->id)
            $Comments = products_commintes::find($req->id);
        else
            $Comments  = new products_commintes();

        $Comments->reviewBody  = $req->reviewBody;
        $Comments->reviewTitle = $req->reviewTitle;
        $Comments->product_id  = $req->product_id;
        $Comments->client_id   = $req->client_id;
        $Comments->rating      = $req->rating;
        $Comments->save();

        return response()->json($Comments);
    }
}
