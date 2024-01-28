<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Short;
use App\Http\Requests\StoreShortRequest;
use App\Http\Requests\UpdateShortRequest;

class ShortApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        $short = Short::activeByCode($code, auth()->user()->id, true)->firstOrFail();

        $this->authorize('view', $short);

        return ['data' => $short];
    }
}
