<?php

namespace App\Imports;

use App\Models\branchs;
use App\Models\branchs_products;
use App\Models\cat;
use App\Models\presnters;
use App\Models\products;
use App\Models\publishers;
use App\Models\translators;
use App\Models\writers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if ($row['writer_id']) {
                $writers = writers::firstOrCreate([
                    "name_ar" => $row['writer_id']
                ]);
            }

            if ($row['presnter_id']) {
                $presnters = presnters::firstOrCreate( [
                    "name_ar" => $row[ 'presnter_id' ]
                ] );
            }

            if ($row['translator_id']) {
                $translators = translators::firstOrCreate( [
                    "name_ar" => $row[ 'translator_id' ]
                ] );
            }
            if ($row['publisher_id']) {
                $publishers = publishers::firstOrCreate( [
                    "name_ar" => $row[ 'publisher_id' ]
                ] );
            }
            if ($row['category']) {
                $cat = cat::firstOrCreate(
                    [ "name_ar" => $row[ 'category' ] ?? 'no Name' ],
                    [ "slug" => $row[ 'category' ] ?? 'no Name' ]
                );
            }
            if ($row['branch']) {
                $branch = branchs::firstOrCreate( [
                    "name_ar" => $row[ 'branch' ]
                ] );
            }
            $product = products::firstOrCreate(
                    [ "name_ar" => $row[ 'name_ar' ] ],
                    [
                        "name_en" => $row[ 'name_en' ],
                        "cover" => $row[ 'cover' ],
                        "writer_id" => $writers->id ?? null,
                        "presnter_id" => $presnters->id ?? null,
                        "translator_id" => $translators->id ?? null,
                        "publisher_id" => $publishers->id ?? null,
                        "paper_type" => $row[ 'paper_type' ],
                        "page_no" => $row[ 'page_no' ],
                        "copies" => $row[ 'copies' ],
                        "print_year" => $row[ 'print_year' ],
                        "release_year" => $row[ 'release_year' ],
                        "print_no" => $row[ 'print_no' ],
                        "price" => $row[ 'price' ],
                        "price_2" => $row[ 'price_2' ],
                        "price_3" => $row[ 'price_3' ],
                        "purchasing_price" => $row[ 'purchasing_price' ],
                        "dimenstion" => $row[ 'dimenstion' ],
                        "lsbn" => $row[ 'lsbn' ],
                        "item_code" => $row[ 'item_code' ],
                        "weight" => $row[ 'weight' ],
                        "is_active" => $row[ 'is_active' ],
                        "use_stoke" => $row[ 'use_stoke' ],
                        "show_stoke" => $row[ 'show_stoke' ],
                        "is_featured" => $row[ 'is_featured' ]
                    ] );
            if ( isset($cat->id) ) {
                $product->cat()->sync( $cat->id );
            }
//            $product->branchs()->sync($branch->id);
            if ($branch->id) {
                branchs_products::firstOrCreate(
                    [ "branchs_id" => $branch->id, "products_id" => $product->id ],
                    [ "stoke" => $row[ 'stoke' ] ]
                );
            }
        }

    }
}
