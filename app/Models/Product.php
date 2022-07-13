<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'image',
        'price',
        'sale_price',
        'image_list',
        'status',
        'category_id',
        'qty'
    ];

    //join 1-1
    public function cat(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class, 'product_id', 'id')->orderBy('id', 'DESC');
    }

    public function scopeNewProduct($query, $limit = 6)
    {
        $query = $query->orderBy('created_at','DESC')->limit($limit);
    
        return $query;
    }

    public function scopeSearch($query)
    {
        if(request('key')){
            $key = request('key');
            $query = $query->where('name','like','%'.$key.'%');
        }
        if(request('cat_id')){
            $query = $query->where('category_id',request('cat_id'));
        }
        return $query;
    }
}