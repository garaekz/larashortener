<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    public function item(Model $model, $transformer, $status = 200)
    {
        return fractal()->item($model, $transformer)->respond($status);
    }
}
