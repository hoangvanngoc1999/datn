<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = [
        'customer_id', 
        'name', 
        'email', 
        'phone',
        'import_price',
        'total_price', 
        'address', 
        'order_note', 
        'status',
        'created_at', 
        'updated_at', 
        'token'];

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
        if(request('status') != null){
            $query = $query->where('status',request('status'));
        }
        if(request('order')!= null){
            $order = request('order');
            $orderArr = explode('-',$order);
            $query = $query->orderBy($orderArr[0], $orderArr[1]);
        }
        if(request('order_by_date')!= null){
            $order_by_date = request('order_by_date');
            $order_by_dateArr = explode('-',$order_by_date); 
            $dateFrom = rtrim($order_by_dateArr[0], ' ').' 00:00:00';
            $dateTo = ltrim($order_by_dateArr[1], ' ').' 12:00:00';
            // $dateFrom = format('DD-MM-YYYY',$dateFrom);
            // $dateTo = format('DD-MM-YYYY',$dateTo);
            // dd($dateFrom,$dateTo);
            $query = $query->whereBetween('created_at', [$dateFrom, $dateTo]);
        }
        return $query;
    }
}