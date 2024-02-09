<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Short;
use Illuminate\Http\Request;

class ShortController extends Controller
{
    public function noapp()
    {
        $app = App::select('ulid')
            ->where('user_id', auth()->id())
            ->first();

        return redirect()->route('shorts.index', $app->ulid);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(App $app)
    {
        $apps = App::select('ulid', 'name')
            ->where('user_id', auth()->id())
            ->get();
        $current = $app->only('ulid', 'name');

        $shorts = Short::whereHasMorph('shortable', [App::class], function ($query) use ($app) {
            $query->where('id', $app->id);
        })
        ->paginate();

        return inertia('Short/Index', [
            'apps' => $apps,
            'current' => $current,
            'shorts' => $shorts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ulid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
