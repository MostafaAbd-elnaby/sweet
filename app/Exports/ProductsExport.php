<?php

namespace App\Exports;

use App\Models\Products;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsExport implements FromArray, WithMapping, WithHeadings//, WithMultipleSheets
{

    protected $Products;
    protected $sheets = [];
    protected $ColumnNams;

    public function __construct($ColumnNams, $products)
    {
        $this->Products = $products;
        $this->ColumnNams = $ColumnNams;
    }

    public function array(): array
    {
        return $this->Products;
    }

    public function map($Products) : array {

            ;
        $ColumnNams = [];
        foreach ($this->ColumnNams as $col) {
            array_push($ColumnNams, $Products[$col]);
        }
        return $ColumnNams;

    }

    public function headings() : array {
       return $this->ColumnNams;
    }
}
