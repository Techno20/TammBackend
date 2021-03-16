<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
    ];
}