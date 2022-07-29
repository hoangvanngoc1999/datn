<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'entry_price'];
    public $timestamp = false; //Bỏ 2 trường created_at, updated_at

    public function prod()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}