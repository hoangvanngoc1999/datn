<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $fillable =['customer_id', 'product_id', 'comment', 'rep_id'];

    public function custom()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function rep()
    {
        return $this->hasMany(Comment::class, 'rep_id', 'id');
    }
}