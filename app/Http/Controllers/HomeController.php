<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
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
        $products = Product::search()
        ->where('status','=','1')->get();
        $category = Category::ListCategory()->get();
        $newProduct = [
            Product::orderBy('created_at','DESC')->offset(0)->limit(3)->get(),
            Product::orderBy('created_at','DESC')->offset(3)->limit(3)->get(),
            Product::orderBy('created_at','DESC')->offset(6)->limit(3)->get(),
        ];
        $topSale = OrderDetail::select(\DB::raw('product.name,product.slug,product.image,product.price,product.sale_price,product_id,sum(quantity) as sum'))
        ->join('product','product.id','=','product_id')
        ->join('order','order_id','=','order.id')->WHERE('order.status','=',2)
        ->where('product.status','=','1')
        ->groupBy('product_id')->orderBy('sum','DESC')->limit(3)->get();
        return view('home', compact('products','category','newProduct','topSale'));
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

    public function category ($id)
    {
        $model = Category::where('id', $id)->first();
        $category = Category::ListCategory()->get();
        
        return view('category', compact('category','model'));
    }

    public function product_detail($slug)
    {
        $pro = Product::where('slug','=',$slug)->first();
        $category = Category::ListCategory()->get();
        $ratingavg= Rating::join('product','product_id','=','id')->where('product.slug','=',$slug)->avg('rating_start');
        
        return view('product_detail', compact('category','pro','ratingavg'));
    }

    public function testEmail()
    {
        $name = 'test name for mail';
        Mail::send('email.test', compact('name'),
        function($email){
            $email->to('hoangvanngoc1999@gmail.com', 'Đồ đồng nát');
        });
    }
    public function lang($lang) {
        if ($lang == 'VN') {
            Session::put('lang','vi');
        } else {
            Session::put('lang','en');
        }
        return redirect()->back();
    }
}