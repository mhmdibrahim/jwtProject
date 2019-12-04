<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client ;
class MovieController extends Controller
{
    public function index(){

        $client = new Client();
        $get_movies = $client->get('https://api.themoviedb.org/3/movie/now_playing?api_key=a7d77d357d15ffe350533e0ee03b87e4&language=en-US&page=1');
        if($get_movies->getStatusCode() == 200) {
            $body_movies = $get_movies->getBody();
            $movies = json_decode($body_movies);
//           dd($movies->results)  ;

    }
        $get_genres = $client->get('https://api.themoviedb.org/3/genre/movie/list?api_key=a7d77d357d15ffe350533e0ee03b87e4&language=en-US');
        if($get_genres->getStatusCode()==200){
            $body_genres = $get_genres->getBody();
            $genres = json_decode($body_genres);
            $genres_names = [];
            foreach ($genres->genres as $key=>$value){
                $genres_names[$value->id] = $value->name ;
            }
        }
//        foreach ($genres_names as $key=>$value){
//            echo $key . "\n" .$value;
//        }
//        exit();
//        dd($genres_names);
//        exit();
//        dd($movies->results);
//        exit();
        foreach ($movies->results as $key=>$values){
            foreach ($values->genre_ids as $key2=>$value2){
            var_dump($value2);
                if(in_array($value2,$genres_names)){
                    echo 'dsad';
                    dd($value2);
                    $value2 = $genres_names[$key2] ;

                }
            }

//            if (in_array($values->genre_ids,$genres_names)){
//                $values->genre_ids = $genres_names ;
//            }
           }
//           dd($movies->results);
        exit();
    }
}
