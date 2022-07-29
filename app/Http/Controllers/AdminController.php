<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderToday = Order::whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        $revenueToday = Order::whereDate('created_at', '=', Carbon::today()->toDateString())->where('status', '=', 2)->sum('total_price'); 
        $customer = Order::whereDate('created_at','=',Carbon::today()->toDateString())->groupBy('customer_id')->count();
        $product = OrderDetail::join('order','order.id','=','order_id')->whereDate('order.created_at','=',Carbon::today()->toDateString())->where('order.status','=','2')->sum('quantity');
        $prdtd = Order::select('order_detail.quantity','order_detail.price','order_detail.entry_price')->join('order_detail','order_id','=','id')->where('order.status','=','2')->whereDate('order.created_at', '=', Carbon::today()->toDateString())->get(); 
        $profitToday = 0;
        if(isset($request->chooseDay)) {
            $customer = Order::whereDate('created_at','=',$request->chooseDay)->groupBy('order.customer_id')->get()->count();
            $orderToday = Order::whereDate('created_at', '=', $request->chooseDay)->count();
            $revenueToday = Order::whereDate('created_at', '=', $request->chooseDay)->where('status', '=', 2)->sum('total_price');
            $prdtd = Order::select('order_detail.quantity','order_detail.price','order_detail.entry_price')->join('order_detail','order_id','=','id')->where('order.status','=','2')->whereDate('order.created_at', '=', $request->chooseDay)->get(); 
            $product = OrderDetail::join('order','order.id','=','order_id')->whereDate('order.created_at','=',$request->chooseDay)->where('order.status','=','2')->sum('quantity');
        }
        foreach ($prdtd as $pr) {
            $profitToday += ($pr['quantity']*$pr['price']) - ($pr['quantity'] * $pr['entry_price']);
        }
        $data = [
            'customer'  => $customer,
            'order'     => Order::count(),
            'product'   => $product,
            'category'  => $profitToday,
            'orderSuccess'  => Order::where('status', '=', 2)->count(),
            'revenue'   => Order::where('status', '=', 2)->sum('total_price'),
            'orderToday' => $orderToday,
            'revenueToday'   => $revenueToday,
            // 'profitToday'   => $profitToday,
        ];
        
        $customer = Order::select(\DB::raw('order.customer_id,COUNT(order.customer_id) as countOrder,customer.name,customer.email,Sum(order.total_price) as sumPrice'))
            ->join('customer', 'customer.id', '=', 'order.customer_id')->where('order.status', '=', 2)->groupBy('order.customer_id')->orderBy('countOrder', 'DESC')->paginate(10);

        // SELECT `created_at`,month(created_at) as month,day(created_at) as day, sum(total_price) as total_price FROM `order` 
        // WHERE status=2 and month(created_at) = month(now()) GROUP BY day order BY day ASC
        $chartMonth = Order::select(\DB::raw('created_at,month(created_at) as month,day(created_at) as day,sum(total_price) as total_price'))
            ->WHERE('status', '=', '2')->whereMonth('created_at', '=', Carbon::now()->month)->whereYear('created_at', '=', Carbon::now()->year)
            ->groupBy('day')->orderBy('day', 'ASC')->get();

        // SELECT `created_at`,YEAR(created_at) as year,month(created_at) as month, sum(total_price) as total_price FROM `order` 
        // WHERE status=2 and year(created_at) = year(now()) GROUP BY month order BY month ASC
        $chartYear = Order::select(\DB::raw('created_at,year(created_at) as year,month(created_at) as month,sum(total_price) as total_price'))
            ->WHERE('status', '=', '2')->whereYear('created_at', '=', Carbon::now()->year)
            ->groupBy('month')->orderBy('month', 'ASC')->get();

        // query tổng tiền những ngày có doanh thu trong tháng hiện tại và năm hiện tại.

        $dayOfChartMonth = [];
        $dataChartMonth = [];
        // khởi tạo 2 hàm labels và data để truyền cho chartJS

        $x = cal_days_in_month(CAL_GREGORIAN, Carbon::now()->month, Carbon::now()->year);

        if(isset($request->chooseMonth) && $request->chooseMonth != 0) {
            $chartMonth = Order::select(\DB::raw('created_at,month(created_at) as month,day(created_at) as day,sum(total_price) as total_price'))
            ->WHERE('status', '=', '2')->whereMonth('created_at', '=', $request->chooseMonth)->whereYear('created_at', '=', Carbon::now()->year)
            ->groupBy('day')->orderBy('day', 'ASC')->get();

            $x = cal_days_in_month(CAL_GREGORIAN, $request->chooseMonth, Carbon::now()->year);
        }

        // lấy số ngày của tháng hiện tại để lặp tạo thành mảng có đủ số ngày của tháng
        for ($i = 1; $i <= $x; $i++) {
            $dayOfChartMonth[] = 'ngày ' . $i;
            foreach ($chartMonth as $key => $chartM) {
                if ($chartM['day'] == $i) {
                    // kiểm tra nếu ngày đó có doanh thu thì add vào mảng
                    $dataChartMonth[] = $chartM['total_price'];
                    unset($chartMonth[$key]);
                    break;
                } else {
                    // không có doanh thu set doanh thu = 0
                    $dataChartMonth[] = 0;
                    break;
                }
            }
            if (count($chartMonth) == 0) {
                $dataChartMonth[] = 0;
            }
        }
        // encode giữ liệu ném sang view cho chart dùng
        $chartMonth = [
            'month'     => Carbon::now()->month,
            'labels'    => json_encode($dayOfChartMonth),
            'dataC'     => json_encode($dataChartMonth)
        ];
        if(isset($request->chooseMonth) && $request->chooseMonth != 0) {
            $chartMonth = [
                'month'     => $request->chooseMonth,
                'labels'    => json_encode($dayOfChartMonth),
                'dataC'     => json_encode($dataChartMonth)
            ];
        }

        $monthOfChartYear = [];
        $dataChartYear = [];
        // tương tự như tháng nhưng ko cần check số lần lặp vì mặc định 1 năm 12 tháng
        for ($j = 1; $j <= 12; $j++) {
            $monthOfChartYear[] = 'tháng ' . $j;
            foreach ($chartYear as $key => $charY) {
                if ($charY['month'] == $j) {
                    $dataChartYear[] = $charY['total_price'];
                    unset($chartYear[$key]);
                    break;
                } else {
                    $dataChartYear[] = 0;
                    break;
                }
                if (count($chartYear) == 0) {
                    $dataChartYear[] = 0;
                }
            }
        }
        $chartYear = [
            'year'     => Carbon::now()->year,
            'labels'    => json_encode($monthOfChartYear),
            'dataY'     => json_encode($dataChartYear)
        ];

        // nếu có yêu cầu lấy giữ liệu theo khoảng ngày // nếu muốn set những ngày không có doanh thu giá trị 0 cần 1 thuật toán khá lằng nhằng // có thể tìm các package xem thử có package nào hỗ trợ không
        if (isset($request->dayStart) && isset($request->dayEnd)) {
            // $chartMonth = Order::select(\DB::raw('created_at,month(created_at) as month,day(created_at) as day,year(created_at) as year,sum(total_price) as total_price'))
            // ->WHERE('status','=','2')->whereBetween('created_at',['CAST('.$request->dayStart.' AS DATE)','CAST('.$request->dayEnd.' AS DATE)'])
            // ->groupBy('day')->orderBy('day','ASC')->get();

            $dayOfChartMonth = [];
            $dataChartMonth = [];
            
            $chartMonth = DB::select("SELECT `created_at`,month(created_at) as month,day(created_at) as day, sum(total_price) as total_price FROM `order` 
            WHERE status=2 and created_at BETWEEN CAST('$request->dayStart' as date) and cast('$request->dayEnd' as date) GROUP BY day order BY day ASC");
            foreach ($chartMonth as $chartM) {
                $dayOfChartMonth[] = $chartM->day .'/'.$chartM->month;
                $dataChartMonth[] = $chartM->total_price;
            }
            $chartMonth = [
                'month'     => $request->dayStart .' đến '. $request->dayEnd,
                'labels'    => json_encode($dayOfChartMonth),
                'dataC'     => json_encode($dataChartMonth)
            ];
        }
        
        return view('admin.index', compact('customer', 'data', 'chartMonth', 'chartYear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login()
    {
        return view('admin.login');
    }

    public function post_login(Request  $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required',
            ],
        );
        $data = $request->only('email', 'password');
        $check_login = Auth::guard('')->attempt($data, $request->has('remember')); // remember->chọn checkbox thì là true
        if ($check_login) {
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error', 'Mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::guard('')->logout();

        return redirect()->route('admin.login');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function exportExcel() 
    {
        
        // dd($data);
        return Excel::download(new ExportExcel, 'Thống kê.xlsx');
        // return Excel::download(function($excel) {
        //     $excel->sheet('sheet1', function($sheet) {
        //         $data = OrderDetail::select(\DB::raw('product_id,product.name,order_detail.price,order_detail.entry_price,sum(order_detail.quantity) as soluong, month(order_detail.created_at) as MonthC,year(order_detail.created_at) as YearC'))-> join('product','id','product_id')->groupBy('product_id')->orderBy('MonthC')->orderBy('YearC')->get();
        //         // Sheet manipulation
        //         $sheet->setCellValue('A1', 'Tháng')
        //         ->setCellValue('B1', 'ID SẢN PHẨM')
        //         ->setCellValue('C1', 'TÊN SẢN PHẨM') // set title cho dòng đầu tiên
        //         ->setCellValue('D1', 'SÔ LƯỢNG BÁN ĐƯỢC')
        //         ->setCellValue('E1', 'DOANH THU')
        //         ->setCellValue('F1', 'LOI NHUAN');
        //     });
        // },'Thống kê.xlsx');
    }
}