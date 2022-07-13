<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = ['customer_id', 'name', 'email', 'phone', 'address', 'order_note', 'status','created_at', 'updated_at', 'token'];

    protected $primaryKey = 'id';
    public function cus()
    {
        return $this->hasOne(Customer::class, 'id','customer_id');
    }
    
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

   

    public function getTotal()
    {
        $total = 0;
        foreach($this->details as $item){
            $total += $item->price * $item->quantity;
        }
        return $total;
    }

    public function scopeSearch($query)
    {
        if(request('key')){
            $key = request('key');
            $query = $query->where('name','like','%'.$key.'%');
        }
        return $query;
    }
}