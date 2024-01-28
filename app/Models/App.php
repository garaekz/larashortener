<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class App extends Model
{
    use HasFactory;
    use HasApiTokens;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shorts()
    {
        return $this->morphMany(Short::class, 'shortable');
    }
}
