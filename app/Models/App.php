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
        'domain',
        'token',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($app) {
            if (empty($app->user_id)) {
                $app->user_id = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shorts()
    {
        return $this->morphMany(Short::class, 'shortable');
    }

    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}
