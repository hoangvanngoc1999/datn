<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() 
    {
        $orders = Order::orderBy('created_at','DESC')->search()->paginate();
        return view('admin.order.index', compact('orders'));
    }

    public function detail(Order $order)
    {
        return view('admin.order.detail', compact('order'));
    }

    public function status(Order $order, Request $request)
    {
        $data = $request->only('status');
        if($order->update($data)){
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại');
    }
}