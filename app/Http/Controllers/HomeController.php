<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $products = Product::newProduct()->search()->get();
        $category = Category::ListCategory()->get();
        return view('home', compact('products','category'));
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

    public function product_detail($id)
    {
        $pro = Product::find($id);
        $category = Category::ListCategory()->get();
        $ratingavg= Rating::where('product_id',$id)->avg('rating_start');
        
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
}