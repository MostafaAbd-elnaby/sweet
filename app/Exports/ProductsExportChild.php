<?php

namespace App\Exports;

use App\Models\Products;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use function Illuminate\Support\Facades\Http;

class ProductsExport implements FromArray, WithMapping, WithHeadings, WithMultipleSheets
{

    protected $Products;
    protected $sheets = [];

    public function __construct()
    {
        set_time_limit(300);
        $mainLimit = 100;
        $limit = 0;
        $offset = 0;
        $count =  3;//round(Products::count() / $mainLimit);
        for ($i=0; $i < $count; $i++ ) {
            $this->Products = Products::offset($offset)->limit($mainLimit)->get()->map(function ($val) {
                return  [
                    'id'               => $val['id'],
                    "name_ar"          => $val['name_ar'],
                    "name_en"          => $val['name_en'],
                    "desc_ar"          => $val['desc_ar'],
                    "desc_en"          => $val['desc_en'],
                    "img"              => $val['img'],
                    "imgs"             => $val['imgs'],
                    "vido"             => $val['vido'],
                    "cats_name"        => $val['cats_name'] ?? 'لايوجد',
                    "writer_id"        => $val['writer_id']['name_ar'] ?? 'لايوجد',
                    "presnter_id"      => $val['presnter_id']['name_ar'] ?? 'لايوجد',
                    "translator_id"    => $val['translator_id']['name_ar'] ?? 'لايوجد',
                    "publisher_id"     => $val['publisher_id']['name_ar'] ?? 'لايوجد',
                    "hard_copy_branch" => $val['hard_copy_branch']['name_ar'] ?? 'لايوجد',
                    "cover"            => $val['cover'],
                    "paper_type"       => $val['paper_type'],
                    "page_no"          => $val['page_no'],
                    "copies"           => $val['copies'],
                    "print_year"       => $val['print_year'],
                    "release_year"     => $val['release_year'],
                    "print_no"         => $val['print_no'],
                    "price"            => $val['price'],
                    "price_2"          => $val['price_2'],
                    "price_3"          => $val['price_3'],
                    "purchasing_price" => $val['purchasing_price'],
                    "dimenstion"       => $val['dimenstion'],
                    "weight"           => $val['weight'],
                    "lsbn"             => $val['lsbn'],
                    "item_code"        => $val['item_code'],
                    "seen_no"          => $val['seen_no'],
                    "rat"              => $val['rat'],
                    "indexs"           => $val['indexs'],
                    "is_active"        => $val['is_active'],
                    "stoke"            => $val['stoke'],
                    "use_stoke"        => $val['use_stoke'],
                    "show_stoke"       => $val['show_stoke'],
                    "is_featured"      => $val['is_featured'],
                    "created_at"       => $val['created_at'],
                    "updated_at"       => $val['updated_at'],

                ];
            })->toArray();
            $this->sheets[] = $this->Products;
            $offset += $mainLimit;
        }
    }

    public function array(): array
    {
        return $this->Products;
    }


    public function sheets(): array
    {
        return $this->sheets;
    }

    public function map($Products) : array {
        // $Products->getCatsNameAttribute();
        return [

            $Products['id'],
            $Products['name_ar'],
            $Products['name_en'],
            $Products['desc_ar'],
            $Products['desc_en'],
            $Products['img'],
            $Products['imgs'],
            $Products['vido'],
            $Products['cats_name'][0]['name_ar'] ?? 'لايوجد',
            $Products['writer_id']['name_ar'] ?? 'لايوجد',
            $Products['presnter_id']['name_ar'] ?? 'لايوجد',
            $Products['translator_id']['name_ar'] ?? 'لايوجد',
            $Products['publisher_id']['name_ar'] ?? 'لايوجد',
            $Products['hard_copy_branch']['name_ar'] ?? 'لايوجد',
            $Products['cover'],
            $Products['paper_type'],
            $Products['page_no'],
            $Products['copies'],
            $Products['print_year'],
            $Products['release_year'],
            $Products['print_no'],
            $Products['price'],
            $Products['price_2'],
            $Products['price_3'],
            $Products['purchasing_price'],
            $Products['dimenstion'],
            $Products['lsbn'],
            $Products['item_code'],
            $Products['seen_no'],
            $Products['rat'],
            $Products['indexs'],
            $Products['is_active'],
            $Products['stoke'],
            $Products['use_stoke'],
            $Products['show_stoke'],
            $Products['is_featured'],
            Carbon::parse($Products['created_at'])->toFormattedDateString(),
            Carbon::parse($Products['updated_at'])->toFormattedDateString()
        ] ;


    }

    public function headings() : array {
        return [
           "#",
           "الاسم باللغة العربية",
           "الاسم باللغة الإنجليزية",
           "الوصف باللغة العربية",
           "الوصف باللغة الإنجليزية",
           "صورة",
           "الصور",
           "فيديو",
           "اسم التصنيف",
           "كاتب",
           "المقدم",
           "المحقق",
           "معرّف الناشر",
           "فرع نسخة ورقية",
           "غطاء",
           "نوع الورق",
           "رقم الصفحة",
           "سنة الطباعة",
           "سنة الإصدار",
           "رقم الطابعة",
           "سعر",
           "سعر1",
           "سعر2",
           "سعر3",
           "سعر الشراء",
           "البعد",
           "lsbn",
           "رمز الصنف",
           "المشاهدات",
           "تقييم",
           "فهارس",
           "غير نشط",
           "بضاعة",
           "استخدام المخزون",
           "عرض المخزون",
           "هو مميز",
           "أنشئت في",
           "تم التحديث في",
                ] ;
    }
}
