<?php
Route::get('/','ReportsController@index');

Route::resource('reports', 'ReportsController');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('reports', 'ReportsController', ['only' => ['index','store', 'destroy']]);
    Route::resource('admin', 'AdminController', ['only' => ['index','edit']]);
});




Route::middleware('verified')->group(function() {
    // 一般ユーザ用
    Route::prefix('user')->group(function(){
        Route::get('/', 'ReportsController@index');
    });
    // 管理ユーザ用
    Route::prefix('admin')->middleware('can:admin')->group(function(){
        Route::get('/', 'AdminController@index');
    });
});
