<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Add product to cart
     *
     * @param Product $product
     * @param Cart $cart
     * @return boolean
     */
    public function add(Product $product, Cart $cart)
    {
        if (Auth::guard('cus')->user() == null) {
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        $result = $cart->add($product);
        if ($result == true) {
            return redirect()->route('cart.view')->with('success', 'Thêm sản phẩm thành công vào giỏ hàng');
        } else {
            return redirect()->route('cart.view')->with('error', 'Thêm sản phẩm thất bại.');;
        }
    }

    /**
     * Update quantity cart
     *
     * @param id $id
     * @param Cart $cart
     * @param Request $request
     * @return void
     */

    public function update($id, Cart $cart, Request $request)
    {
        $quantityPrd = Product::find($id)['qty'];
        if ($request->quantity > $quantityPrd) {
            return redirect()->route('cart.view')->with('error', 'Cập nhật giỏ hàng thất bại. Chỉ còn ' . $quantityPrd . ' sản phẩm trong kho');
        }
        $quantity = ($request->quantity && $request->quantity) > 0 ? floor($request->quantity) : 1;
        $cart->update($id, $quantity);
        return redirect()->route('cart.view')->with('success', 'Cập nhật giỏ hàng thành công');
    }

    /**
     * Delete Product in cart
     *
     * @param id $id
     * @param Cart $cart
     * @return void
     */
    public function delete($id, Cart $cart)
    {
        $cart->Delete($id);

        return redirect()->route('cart.view');
    }

    /**
     * CLear cart
     *
     * @param Cart $cart
     * @return void
     */
    public function clear(Cart $cart)
    {
        $cart->clearAll();

        return redirect()->route('cart.view');
    }

    /**
     * View cart
     *
     * @param Cart $cart
     * @return void
     */
    public function view(Cart $cart)
    {
        if (Auth::guard('cus')->user() == null) {
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }
        $carts = $cart->getCart();
        $totalQtt = $cart->GetTotal();
        $totalPrice = $cart->GetTotal(true);
        $promotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get();
        $checkPromotion = Promotion::where('status', '=', '0')->whereRaw('date("' . Carbon::today()->toDateTimeString() . '") BETWEEN date(time_start) and date(time_end)')->limit(1)->get()->count();
        if ($checkPromotion == 0) {
            $promotion = 'false';
        }
        return view('cart', compact('carts', 'totalQtt', 'totalPrice', 'promotion'));
    }
}