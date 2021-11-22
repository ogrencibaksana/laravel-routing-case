<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $artists = Artist::withCount('art')->paginate();
        return view('artists.list', compact('artists'));
    }


    /**
     * Display the specified resource.
     *
     * @param Artist $artist
     * @return Application|Factory|View
     */
    public function show(Artist $artist)
    {
        $artist->load('art');
        return view('artists.view', compact('artist'));
    }
}
