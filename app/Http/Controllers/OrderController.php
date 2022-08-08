<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::search()->orderBY('id', 'DESC')->paginate(15);
        return view('admin.order.index', compact('orders'));
    }

    public function detail(Order $order)
    {
        $pdf = PDF::loadView('pdf.order_detail', compact('order'));
        if (request('pdf', false)) {
            return $pdf->stream();
        } elseif (request('download', false)) {
            return $pdf->download($order->name . '-' . time() . '.pdf');
        }
        return view('admin.order.detail', compact('order'));
    }

    public function status(Order $order, Request $request)
    {

        $data = $request->only('status');
        $oldStatus = $order->status;
        $customer = $order->customer_id;
        $total_price = $order->total_price;
        if ($order->update($data)) {
            $detail = OrderDetail::select('product.id', 'order_detail.quantity', 'product.qty')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->where('order_detail.order_id', '=', $order->id)->get();
            if ($request->status == 2 || $request->status == 1 || $request->status == 4 || $request->status == 5) {
                foreach ($detail as $dt) {
                    if ($dt['qty'] >= $dt['quantity']) {
                    } else {
                        $data = [
                            'status'    =>  3
                        ];
                        $order->update($data);
                        return redirect()->back()->with('error', 'Cập nhật thất bại ! Hiện tại sản phẩm đã hết hàng !! Xin chân thành xin lỗi');
                    }
                }
                if ($oldStatus == 0) {
                    foreach ($detail as $det) {
                        Product::where('id', '=', $det['id'])->update(['qty' => ($det['qty'] - $det['quantity'])]);
                    }
                }
                if ($request->status == 2) {
                    $tich_diem = Customer::select('tich_diem')->where('id', '=', $customer)->get();
                    Customer::where('id', '=', $customer)->update(['tich_diem' => ($tich_diem[0]['tich_diem'] + $total_price)]);
                }
            } else if ($request->status == 3) {
                if ($oldStatus != 0) {
                    foreach ($detail as $dt) {
                        Product::where('id', '=', $dt['id'])->update(['qty' => ($dt['qty'] + $dt['quantity'])]);
                    }
                }
            }
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Xóa đơn hàng thành công');
    }
    public function show($id)
    {
        //
    }
}