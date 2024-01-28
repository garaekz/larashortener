<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Short extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'url',
        'code',
        'hits',
        'user_id',
        'app_id',
        'expires_at',
        'last_hit_at',
        'status',
    ];
}
