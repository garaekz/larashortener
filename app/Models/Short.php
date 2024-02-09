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
        'expires_at',
        'last_hit_at',
        'status',
    ];

    protected $casts = [
        'status' => ShortEnum::class,
        'expires_at' => 'datetime',
        'last_hit_at' => 'datetime',
    ];

    public function shortable()
    {
        return $this->morphTo();
    }

    public function scopeActiveByCode($query, $code, $model)
    {
        return $query->where('code', $code)
            ->where('status', ShortEnum::ACTIVE)
            ->where(function ($q) use ($model) {
                $q->where('shortable_id', $model->id)
                  ->where('shortable_type', $model->getMorphClass());
            });
    }

    public function scopeFindByUrl($query, $url, $model)
    {
        return $query->where('url', $url)
            ->where('status', ShortEnum::ACTIVE)
            ->where(function ($q) use ($model) {
                $q->where('shortable_id', $model->id)
                  ->where('shortable_type', $model->getMorphClass());
            });
    }
}
