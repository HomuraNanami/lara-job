<?php

Route::get('/', 'Front\TopPageController@show');
Route::resource('jobs', 'Front\JobsController', ['only' => ['index', 'show']])->names([
    'index' => 'jobs.index',
    'show' => 'jobs.show',
]);

// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::group(['middleware' => ['auth:user']], function () {

        // TOPページ
        Route::get('home', 'HomeController@show')->name('home');

    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::get('home', 'HomeController@show')->name('home');
        
        Route::resource('users', 'UsersController', ['only' => ['index', 'show']])->names([
            'index' => 'users.index',
            'show' => 'users.show',
        ]);
        Route::post('users/{user}/entries-change-status', 'UsersController@changeEntriesStatus')->name('users.change-entries-status');


    });

});