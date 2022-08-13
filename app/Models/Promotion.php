<?php

namespace App\Models;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'time_start',
        'name',
        'time_end',
        'create_by',
        'type',
        'type',
        'detail',
        'created_at'
    ];
}