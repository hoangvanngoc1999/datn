<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Category extends BaseModel
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'name',
        'status'
    ];

    //Join 1-n
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function scopeListCategory($query, $limit=6)
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
        return $query;
    }
}