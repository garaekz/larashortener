<?php

namespace App\Actions;

use App\Models\App;
use App\Models\Short;
use Exception;

class GenerateShortCode
{
    const MAX_ATTEMPTS = 10;
    const MAX_RETRIES = 10;

    public function execute($short, $tries = 0)
    {
        $minCodeLength = $this->getMinCodeLength($short->shortable);
        $maxAttempts = self::MAX_ATTEMPTS;

        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            $code = $this->generateCode($minCodeLength);

            if (!$this->codeExists($code, $short)) {
                return $code;
            }
        }

        if ($tries < self::MAX_RETRIES) {
            $this->incrementMinCodeLength($short->shortable);
            return $this->execute($short, $tries + 1);
        }

        throw new Exception('Unable to generate unique code after maximum attempts and increments.');
    }

    private function incrementMinCodeLength($shortable)
    {
        $setting = $shortable->settings()->firstOrNew(['key' => 'min_code_length']);
        $setting->value = $setting->value + 1;
        $setting->save();
    }

    private function getMinCodeLength($shortable)
    {
        $setting = $shortable->settings()->firstOrCreate(['key' => 'min_code_length', 'value' => config('app.code_generator.min_length')]);
        return $setting->value;
    }

    private function generateCode($length)
    {
        $runes = config('app.code_generator.runes');
        $base = strlen($runes);
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $index = ord(random_bytes(1)) % $base;
            $code .= $runes[$index];
        }

        return $code;
    }

    private function codeExists($code, $short)
    {
        $cacheKey = "short:{$short->urlable_type}:{$short->urlable_id}:{$code}";

        return cache()->remember($cacheKey, now()->addMinutes(10), function () use ($code, $short) {
            return Short::where('code', $code)
                ->where('urlable_type', $short->urlable_type)
                ->where('urlable_id', $short->urlable_id)
                ->exists();
        });
    }
}