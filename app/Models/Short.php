<?php

namespace App\Models;

use App\Enums\ShortEnum;
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

    protected $casts = [
        'status' => ShortEnum::class,
        'expires_at' => 'datetime',
        'last_hit_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function scopeActiveByCode($query, $code, $id, $isApp = false)
    {
        $column = $isApp ? 'app_id' : 'user_id';
        return $query->where('code', $code)
            ->where($column, $id)
            ->where('status', ShortEnum::ACTIVE);
    }
}
