<?php

namespace App\Http\Controllers;

use App\Http\Requests\App\StoreAppRequest;
use App\Http\Requests\App\UpdateAppRequest;
use App\Models\App;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Apps', [
            'apps' => App::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppRequest $request)
    {
        $app = App::create($request->validated());
        
        return redirect()->route('apps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(App $app)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(App $app)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppRequest $request, App $app)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(App $app)
    {
        //
    }

    public function token(App $app)
    {
        $app->tokens()->delete();
        $token = $app->createToken($app->name, ['shorts:view', 'shorts:create'])->plainTextToken;
        $tokenParts = explode('|', $token);
        return response()->json(['token' => $tokenParts[1]]);
    }
}
