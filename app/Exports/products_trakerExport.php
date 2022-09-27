<?php

namespace App\Exports;

use App\Models\products_traker;
use Maatwebsite\Excel\Concerns\FromCollection;

class products_trakerExport implements FromCollection
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return products_traker::where('products_id', $this->id)->get();
    }
}
