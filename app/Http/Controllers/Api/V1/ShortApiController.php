<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Short\StoreShortApiRequest;
use App\Models\Short;
use App\Transformers\ShortApiTransformer;

class ShortApiController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortApiRequest $request)
    {
        $short = Short::findByUrl($request->url, auth()->user())->first();
        
        if (!$short) {
            $data = $request->validated();
            $short = auth()->user()->shorts()->create($data);
        }

        return $this->item($short, new ShortApiTransformer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($code)
    {
        $short = Short::activeByCode($code, auth()->user())->firstOrFail();

        $this->authorize('view', $short);

        return ['data' => $short];
    }
}
