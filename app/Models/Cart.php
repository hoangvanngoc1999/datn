<?php
namespace App\Models;

class Cart
{
    public $totalQuantity = 0;
    public $totalPriece = 0;

    public function add($product, $quantity = 1)
    {
        if ($product->qty == 0) {
            return false;
        } else {
            $carts = $this -> getCart(); // lấy dữ liệu
            if(isset($carts[$product->id])){
                if($carts[$product->id]->quantity + 1 >  $product->qty) {
                    return false;
                }
                $carts[$product->id]->quantity += $quantity;
            }else{
                $item = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->sale_price > 0 ? $product->sale_price : $product->price,
                    'entry_price' => $product->entry_price,
                    'quantity' => $quantity
                ];
                $carts[$product->id] = (object)$item;
            }
            session(['cart' => $carts]); // cách lưu
            return true;
        }
    }

    public function update($id, $quantity = 1)
    {
        $carts = $this -> getCart();
        
        if(isset($carts[$id])){
           $carts[$id]->quantity = $quantity;
           session(['cart' => $carts]);
        }
    }

    public function Delete($id)
    {
        $carts = $this -> getCart();
        
        if(isset($carts[$id])){
           unset( $carts[$id]);
           session(['cart' => $carts]);
        }
    }

    public function clearAll()
    {
        session(['cart' => '']);
    }

    public function getCart()
    {
        $carts = session('cart') ? session('cart') : []; // lấy dữ liệu

        return $carts;
    }
    public function GetTotal($isPrice = false)
    {
        $total = 0;
        $carts = $this->GetCart();
        foreach($carts as $item){
            if($isPrice){
                $total += $item->quantity * $item->price;
            }else{
                $total += $item->quantity;
            }

        }
        return $total;
    }
}