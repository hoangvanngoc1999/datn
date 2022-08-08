<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('sale_price', '=', 0)->search()
            ->where('status', '=', '1')->paginate(3);
        $category = Category::ListCategory()->get();
        $newProduct = [
            Product::orderBy('id', 'DESC')->where('sale_price', '>', 0)->offset(0)->limit(3)->get(),
            Product::orderBy('id', 'DESC')->where('sale_price', '>', 0)->offset(3)->limit(3)->get(),
            Product::orderBy('id', 'DESC')->where('sale_price', '>', 0)->offset(6)->limit(3)->get(),
        ];
        $topSale = OrderDetail::select(\DB::raw('product.name,product.slug,product.image,product.price,product.sale_price,product_id,sum(quantity) as sum'))
            ->join('product', 'product.id', '=', 'product_id')
            ->join('order', 'order_id', '=', 'order.id')->WHERE('order.status', '=', 2)
            ->where('product.status', '=', '1')
            ->groupBy('product_id')->orderBy('sum', 'DESC')->limit(3)->get();
        $promotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get();
        $checkPromotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get()->count();
        if ($checkPromotion == 0) {
            $promotion = 'false';
        }
        return view('home', compact('products', 'category', 'newProduct', 'topSale', 'promotion'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        return view('shop');
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

    public function category($id)
    {
        $model = Category::where('id', $id)->first();
        $category = Category::ListCategory()->get();
        $promotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get();
        $checkPromotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get()->count();
        if ($checkPromotion == 0) {
            $promotion = 'false';
        }
        return view('category', compact('category', 'model', 'promotion'));
    }

    public function product_detail($slug)
    {
        $pro = Product::where('slug', '=', $slug)->first();
        $category = Category::ListCategory()->get();
        $ratingavg = Rating::join('product', 'product_id', '=', 'id')->where('product.slug', '=', $slug)->avg('rating_start');
        $promotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get();
        $checkPromotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get()->count();
        if ($checkPromotion == 0) {
            $promotion = 'false';
        }
        return view('product_detail', compact('category', 'pro', 'ratingavg', 'promotion'));
    }

    public function testEmail()
    {
        $name = 'test name for mail';
        Mail::send(
            'email.test',
            compact('name'),
            function ($email) {
                $email->to('hoangvanngoc1999@gmail.com', 'Đồ đồng nát');
            }
        );
    }
    public function lang($lang)
    {
        if ($lang == 'VN') {
            Session::put('lang', 'vi');
        } else {
            Session::put('lang', 'en');
        }
        return redirect()->back();
    }
}