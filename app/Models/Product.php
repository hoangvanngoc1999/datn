<?php

namespace App\Models;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'sale_price',
        'entry_price',
        'image_list',
        'status',
        'active',
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
        if(request('price')!= null){
            $price = request('price');
            $priceSort = explode('-',$price);
            $query = $query->orderBy($priceSort[0], $priceSort[1]);
        }
        if(request('name')!= null){
            $name = request('name');
            $nameSort = explode('-',$name);
            $query = $query->orderBy($nameSort[0], $nameSort[1]);
        }
        if(request('key')){
            $key = request('key');
            $query = $query->where('name','like','%'.$key.'%');
        }
        if(request('cat_id')){
            $query = $query->where('category_id',request('cat_id'));
        }
        if(request('for-price') && request('to-price') && (request('for-price') < request('to-price') ) ) {
            $query = $query->where('price','>=',request('for-price'))->Where('price','<=',request('to-price'));
        }
        return $query;
    }
}