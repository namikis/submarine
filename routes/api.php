<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/favo/getFavo', 'api\favoApiController@getFavo');
Route::post('/favo/updateFavo', 'api\favoApiController@updateFavo');

Route::post('/home/getVarious', 'api\homeApiController@getVarious');
Route::post('/home/getSearch', 'api\homeApiController@getSearch');
Route::post('/home/getFavorite', 'api\homeApiController@getFavorite');

Route::post('/home/getAutoVarious', 'api\homeApiController@getAutoVarious');
Route::post('/home/getAutoSearch', 'api\homeApiController@getAutoSearch');
Route::post('/home/getAutoFavorite', 'api\homeApiController@getAutoFavorite');

Route::post('/home/getTags', 'api\homeApiController@getTags');
Route::post('/home/getAutoTags', 'api\homeApiController@getAutoTags');

Route::post('/home/getMyContents', 'api\homeApiController@getMyContents');