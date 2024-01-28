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
        $app = $model->shortable;
        $url = Str::startsWith($app->domain, ['http://', 'https://']) ? "{$app->domain}/{$model->code}" : "https://{$app->domain}/{$model->code}";

        return [
            'original_url' => $model->url,
            'short_url' => $url,
        ];
    }
}
