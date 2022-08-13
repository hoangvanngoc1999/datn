<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'customer';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'tich_diem',
        'remember_token',
        'status',
        'token'
    ];

    public function scopeSearch($query)
    {
        if(request('key')){
            $key = request('key');
            $query = $query->where('name','like','%'.$key.'%');
        }
        return $query;
    }
}