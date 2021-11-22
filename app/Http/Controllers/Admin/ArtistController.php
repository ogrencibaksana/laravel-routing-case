<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Art;
use App\Models\Artist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class ArtistController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View
    {
        return view('artists.editor', ['artist' => new Artist()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArtistRequest $request
     * @return RedirectResponse
     */
    public function store(StoreArtistRequest $request): RedirectResponse
    {
        $artist = Artist::create($request->validated());

        return Redirect::route('artists.show', $artist);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Artist $artist
     * @return Application|Factory|View
     */
    public function edit(Artist $artist): View
    {
        return view('artists.editor', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArtistRequest $request
     * @param Artist $artist
     * @return RedirectResponse
     */
    public function update(UpdateArtistRequest $request, Artist $artist): RedirectResponse
    {
        $artist->update($request->validated());
        return Redirect::route('artists.show', $artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Artist $artist
     * @return RedirectResponse
     */
    public function destroy(Artist $artist): RedirectResponse
    {
        $artist->delete();
        return Redirect::route('artists.index');

    }
}
