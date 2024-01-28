<?php

namespace App\Observers;

use App\Actions\GenerateShortCode;
use App\Models\Short;
use Exception;

class ShortObserver
{
    /**
     * Handle the Short "creating" event.
     */
    public function creating(Short $short): void
    {
        if (!$short->code) {
            $short->code = (new GenerateShortCode())->execute($short);
        }
    }
}
