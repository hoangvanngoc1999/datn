<?php

namespace App\Exports;

use App\Models\Excel;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportExcel implements FromView
{
    /**
     * 
     */  
    public function view(): View
    {
        $data = OrderDetail::select(\DB::raw('product_id,product.name,order_detail.price,order_detail.entry_price,sum(order_detail.quantity) as soluong, month(order_detail.created_at) as MonthC,year(order_detail.created_at) as YearC'))-> join('product','id','product_id')->join('order','order.id','order_detail.order_id')->where('order.status','=','2') ->groupBy('product_id')->orderBy('MonthC')->orderBy('YearC')->get(); 
        return view('admin.excel', [
            'data' =>  $data
        ]);
    }
    // public function collection()
    // {
    //     $data = OrderDetail::select(\DB::raw('product_id,product.name,order_detail.price,order_detail.entry_price,sum(order_detail.quantity) as soluong, month(order_detail.created_at) as MonthC,year(order_detail.created_at) as YearC'))-> join('product','id','product_id')->join('order','order.id','order_detail.order_id')->where('order.status','=','2') ->groupBy('product_id')->orderBy('MonthC')->orderBy('YearC')->get();   
    //     return $data;
    // }

    // public function headings(): array
    // {
    //     $headings = [
    //         'Tháng',
    //         'ID sản phẩm',
    //         'Tên sản phẩm',
    //         'Số lượng bán được',
    //         'Doanh thu',
    //         'Lợi nhuận'
    //     ];

    //     return $headings;
    // }
    // public function map($data): array
    // {
    //     $column = [
    //         $data->MonthC .'/'.$data->YearC,
    //         $data->product_id,
    //         $data->name,
    //         $data->soluong,
    //         $data->price * $data->soluong,
    //         ($data->price * $data->soluong) - ($data->entry_price * $data->soluong)
    //     ];
    //     return $column;
    // }
}
