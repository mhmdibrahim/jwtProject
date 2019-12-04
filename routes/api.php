<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
});
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://developers.themoviedb.org/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);

Route::get('movie','MovieController@index');

// Create Endpoint


// That returns the now playing movies and include with every movie its genres
// You will need to use two endpoints to accomplish this : nowPlaying, Genres
// Use Guzzle to make a get request to genres endpoint and store them in an array
//Use Guzzle again to make a get request to now_playing endpoint .. Loop through the
// retrieved movies and for each movie replace the genre ids array with the names of the genres
// .i.e by default for each movie there will be an array of ids called genres like
// [1,3,4,6]
// remove this property from each movie and add another property that holds the names the
// genres like ['Action','Drama', 'Romance','Comdey']
// and return the final movies after you modified the genres

// You will need to learn how to make a request with guzzle and how to parse its response

