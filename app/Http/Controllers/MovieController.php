<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function movies($pageId) {

        $token = config('services.tmdb.token');
        $uri = "https://api.themoviedb.org/3/trending/movie/week?page=".$pageId;
        $response = Http::withToken($token)->acceptJson()->get($uri);
        return $response;
    }
    public function movie($movieId) {

        $token = config('services.tmdb.token');
        $uri = "https://api.themoviedb.org/3/movie/".$movieId;
        $response = Http::withToken($token)->acceptJson()->get($uri);
        return $response;
    }
    public function search(Request $request) {
        $pageId = $request->input('page');
        $query = $request->input('query');

        $token = config('services.tmdb.token');
        $uri = "https://api.themoviedb.org/3/search/movie?page=".$pageId."&query=".$query;
        $response = Http::withToken($token)->acceptJson()->get($uri);
        return $response;
    }
}
