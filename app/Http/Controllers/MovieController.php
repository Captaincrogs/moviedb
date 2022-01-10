<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use SebastianBergmann\Environment\Runtime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Movie $movie)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key='.env('TMDB_API_KEY').'&language=en-US&page=1');
        $movies = json_decode($response->getBody())->results;
        // only best rated are shown in blade 
        $movies = collect($movies)->filter(function($movie) {
            return $movie->vote_average >= 7;
        })->sortByDesc('vote_average')->take(10);
        // the duration with (runtime)
        $movies = $movies->map(function($movie) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'.$movie->id.'?api_key='.env('TMDB_API_KEY').'&language=en-US');
            $movie = json_decode($response->getBody());
            $movie->runtime = $movie->runtime;
            $movie->genres = collect($movie->genres)->pluck('name')->implode(', ');
            return $movie;
            
        });

        //also teturn the youtube trailer
        $movies = $movies->map(function($movie) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'.$movie->id.'/videos?api_key='.env('TMDB_API_KEY').'&language=en-US');
            $trailer = json_decode($response->getBody())->results;
            $trailer = collect($trailer)->firstWhere('site', 'YouTube');
            $movie->trailer = $trailer;
            return $movie;
        });
        return view('movies', compact('movies'));
        // $movies = Movie::with('reviews')->orderBy('reviews_count', 'desc')->take(10)->get();

    }

    public function streamMovie()
    {
        return view('stream');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Movie $movie)
    {
        //search movie by title form tmdb
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/search/movie?api_key='.env('TMDB_API_KEY').'&language=en-US&query='.$request->title);
        $movies = json_decode($response->getBody())->results;
        $movies = collect($movies)->take(1);

        //   //also return the youtube trailer from search results
        $movies = $movies->map(function($movie) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/'.$movie->id.'/videos?api_key='.env('TMDB_API_KEY').'&language=en-US');
            $trailer = json_decode($response->getBody())->results;
            $trailer = collect($trailer)->firstWhere('site', 'YouTube');
            $movie->trailer = $trailer;
            return $movie;

        });

        return view('searchResults', compact('movies'));
        }
        

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
