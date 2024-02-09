<?php

namespace App\Transformers;

use App\Models\Short;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class ShortApiTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Short $model)
    {
        return [
            'original_url' => $model->url,
            'code' => $model->code,
        ];
    }
}
