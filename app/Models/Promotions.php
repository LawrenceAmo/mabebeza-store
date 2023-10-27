<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    use HasFactory;

    protected $primaryKey = 'promotionID'; 

    protected $fillable = [
        'comments',
        'description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'status',
        'promotion_name', // Add this property to allow mass assignment
    ];

}
