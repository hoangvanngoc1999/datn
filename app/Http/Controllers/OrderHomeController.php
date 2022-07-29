<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;
use PDF;

class OrderHomeController extends Controller
{
    public function checkout(Cart $cart)
    {
        $account = Auth::guard('cus')->user();
        $carts = $cart->getCart();
        $totalQtt = $cart->GetTotal();
        $totalPrice = $cart->GetTotal(true);
        if ($totalQtt == 0) {
            return view('cart-empty')->with('error', 'Giỏ hàng của bạn đang trống, vui lòng mua hàng');
        }
        return view('checkout', compact('carts', 'totalQtt', 'totalPrice', 'account'));
    }

    public function post_checkout(Request $request, Cart $cart)
    {
        $auth = Auth::guard('cus')->user();
        $token = Str::random(20);
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ],
        );
        $data = $request->only('name', 'email', 'phone', 'address', 'order_note');
        $data['customer_id'] = $auth->id;
        $data['token'] = $token;
        $totalPrice = $cart->GetTotal(true);
        $data['total_price'] = $totalPrice;
        if ($order = Order::create($data)) {
            $carts = $cart->getCart();
            foreach ($carts as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'entry_price' => $item->entry_price
                ]);
            }
            // send email xác nhận
            Mail::send(
                'email.check_order',
                compact('order', 'auth'),
                function ($email) use ($auth) {
                    $email->subject('My shop - Xác nhận đơn hàng');
                    $email->to($auth->email, $auth->name);
                }
            );
            $cart->clearAll();
            return redirect()->route('order.success');
        }
        return redirect()->back()->with('error', 'Đặt hàng không thành công, vui lòng thử lại');
    }

    public function success()
    {
        return view('order_success');
    }

    public function history()
    {
        $account_id = Auth::guard('cus')->user()->id;
        $orders = Order::where('customer_id', $account_id)->paginate();
        return view('order_history', compact('orders'));
    }

    public function detail(Order $order)
    {
        // dd($order);
        $pdf = PDF::loadView('pdf.order_detail', compact('order'));
        if (request('pdf', false)) {
            return $pdf->stream();
        } elseif (request('download', false)) {
            return $pdf->download($order->name . '-' . time() . '.pdf');
        }
        return view('order_detail', compact('order'));
    }

    public function accept(Order $order, $token)
    {
        $auth = Auth::guard('cus')->user();
        if ($order->token === $token) {
            $order->update(['status' => 1]);

            $detail = OrderDetail::select('product.id', 'order_detail.quantity', 'product.qty')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->where('order_detail.order_id', '=', $order->id)->get();
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
            foreach ($detail as $det) {
                Product::where('id', '=', $det['id'])->update(['qty' => ($det['qty'] - $det['quantity'])]);
            }
            //send mail xác nhận
            Mail::send(
                'email.order_accepted',
                compact('order', 'auth'),
                function ($email) use ($auth) {
                    $email->subject('My shop - Xác nhận đơn hàng thành công');
                    $email->to($auth->email, $auth->name);
                }
            );
        }
        return redirect()->route('order.order_success');
    }

    public function order_success()
    {
        return view('order_accept_success');
    }
}