<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
{
    $movies = Movie::with(['directors', 'actors', 'genres', 'ratings'])->get();
    return response()->json($movies);
}


    public function show($id)
    {
        $movies = Movie::with(['directors', 'actors', 'genres', 'ratings'])->findOrFail($id);
        return response()->json($movie);
    }

    public function moviesWithGenres()
    {
        $movies = Movie::with('genres')->get();
        return response()->json($movies);
    }
    public function moviesByGenre($genreId)
    {
        // Fetch movies associated with the specified genre
        $movies = Movie::whereHas('genres', function ($query) use ($genreId) {
            $query->where('gen_id', $genreId);
        })->with(['directors', 'actors', 'genres', 'ratings.reviewer'])->get();

        // Return the response in JSON format
        return response()->json($movies);
    }
    public function moviesWithRatings()
    {
        $movies = Movie::with(['ratings', 'ratings.reviewer'])->get();
        return response()->json($movies);
    }
}
