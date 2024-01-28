<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Short\StoreShortApiRequest;
use App\Models\Short;
class ShortApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortApiRequest $request)
    {
        $data = $request->validated();
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
