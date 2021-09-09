<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//静的ページ
Route::get('/', function () {
    return view('top');
});

Route::get('/intro','homeController@intro');

Route::get('/account','homeController@account');
Route::get('/account_update','homeController@account_update');
Route::post('/account_update_done','homeController@account_update_done');
Route::get('/account/delete','homeController@account_delete_done');

Route::get('/signIn','loginController@signIn');
Route::post('/login','loginController@user_login');

Route::get('/signUp','loginController@signUp');
Route::post('/register','loginController@register');

Route::get('/logout','loginController@logout');

Route::get('/home','homeController@index');

Route::get('/search','mainController@search');
Route::get('/favorite','mainController@favorite');
Route::get('/various','mainController@various');
Route::get('/content_detail','mainController@detail');

Route::get('/update_favo','mainController@update_favo');

Route::get('/home', 'homeController@index')->name('home');

Route::get('/content/form', 'contentController@insert_form');
Route::post('/content/preview', 'contentController@preview_form');
Route::post('/content/insert', 'contentController@insert');

Route::get('/content/edit', 'contentController@content_edit');
Route::post('/content/edit', 'contentController@content_edit_done');
Route::get('/content/delete', 'contentController@content_delete');

Route::post('/content/approval', 'mailSendController@sendApproMail');
Route::get('/content/appro', 'contentController@approval');

Route::get('/content/approval/done', 'contentController@approval_done');
