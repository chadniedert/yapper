<?php

namespace App\Http\Controllers;

use App\Models\Yap;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class YapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Yaps/Index', [
            'yaps' => Yap::with('user:id,name')->latest()->get(),
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->yaps()->create($validated);

        return redirect(route('yaps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Yap $yap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Yap $yap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Yap $yap): RedirectResponse
    {
        Gate::authorize('update', $yap);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $yap->update($validated);
 
        return redirect(route('yaps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Yap $yap)
    {
        //
    }
}
