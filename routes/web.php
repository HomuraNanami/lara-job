<?php

Route::get('/', 'Front\TopPageController@show')->name('index');
Route::get('jobs', 'Front\JobsController@index')->name('jobs.index');

Route::group(['middleware' => ['auth:user']], function () {
    // TOPページ
    Route::get('home', 'HomeController@show')->name('home');
    Route::get('jobs/{job}', 'Front\JobsController@show')->name('jobs.show');
    Route::get('jobs/{job}/entry', 'Front\EntryController@show')->name('jobs.entry.show');
    Route::post('jobs/{job}/entry', 'Front\EntryController@store')->name('jobs.entry.store');
});

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
        Route::get('home', 'HomeController@index')->name('home');
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
        
        Route::prefix('jobs')->name('jobs.')->group(function () {
            Route::resource('categories', 'CategoriesController');
            Route::post('{job}/entries-change-status', 'JobsController@changeEntriesStatus')->name('change-entries-status');
        });
        Route::resource('jobs', 'JobsController');
    });

});