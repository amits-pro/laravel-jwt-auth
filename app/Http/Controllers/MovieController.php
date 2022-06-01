<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function movies($pageId) {

        $validator = Validator::make(
            [
              'pageId' => $pageId,
            ],
            [
              'pageId' => ['required','integer'],
            ] 
          );
   
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'errors'=>$validator->errors()
            ],422);                
        }

        

        $token = config('services.tmdb.token');
        $uri = "https://api.themoviedb.org/3/trending/movie/week?page=".$pageId;
        $response = Http::withToken($token)->acceptJson()->get($uri);
        return $response;
    }
    public function movie($movieId) {

        $validator = Validator::make(
            [
              'movieId' => $movieId,
            ],
            [
              'movieId' => ['required','integer'],
            ] 
          );
   
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'errors'=>$validator->errors()
            ],422);                
        }

        $token = config('services.tmdb.token');
        $uri = "https://api.themoviedb.org/3/movie/".$movieId;
        $response = Http::withToken($token)->acceptJson()->get($uri);
        return $response;
    }
    public function search(Request $request) {

        $validator = Validator::make($request->all(), [
            'page' => 'required|integer',
            'query' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'errors'=>$validator->errors()
            ],422);                
        }

        $pageId = $request->input('page');
        $query = $request->input('query');

        $token = config('services.tmdb.token');
        $uri = "https://api.themoviedb.org/3/search/movie?page=".$pageId."&query=".$query;
        $response = Http::withToken($token)->acceptJson()->get($uri);
        return $response;
    }
}
