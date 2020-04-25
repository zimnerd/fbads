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

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::get('/home','Auth\LoginController@showLoginForm');
    Route::post('post-login', 'Auth\LoginController@@postLogin');

    Auth::routes();
    Route::group(['middleware' => ['role:user']], function () {
        Route::resource('campaigns', 'CampaignController');
        Route::resource('creatives', 'CreativeController');
        Route::resource('dashboard', 'HomeController');
        Route::post('creatives/delete_media', 'CreativeController@delete_media')->name('creatives.delete_media');
        Route::post('creatives/delete_edit_media', 'CreativeController@delete_edit_media')->name('creatives.delete_edit_media');
        Route::post('creatives/media', 'CreativeController@storeMedia')->name('creatives.storeMedia');
        Route::get('creatives/media/{id}', 'CreativeController@getStoredMedia')->name('creatives.getStoredMedia');
        Route::get('creatives/ss/{id}', 'CreativeController@getScreenshot')->name('creatives.getScreenshot');
        Route::put('creatives/{id}/comment', 'CreativeController@getScreenshot')->name('creatives.getScreenshot');
        Route::get('/campaigns/download/{path}', 'CampaignController@download')->name('campaigns.download');
        Route::put('/campaigns/edit_status/{id}/{status}', 'CampaignController@edit_status')->name('campaigns.edit_status');
        Route::get('campaigns/downloadPDF/{id}','CampaignController@downloadPDF');
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/creatives/live_update', 'CreativeController@live_update')->name('creatives.live_update');
        Route::get('/campaigns/{id}/{capture}', 'CampaignController@show')->name('campaigns.show');
        Route::get('/creatives/{creative}/edit/{action}', 'CreativeController@edit')->name('creatives.edit');
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::get('/roles/move/move-up', 'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down', 'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/', 'MenuElementController@index')->name('menu.index');
            Route::get('/move-up', 'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down', 'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create', 'MenuElementController@create')->name('menu.create');
            Route::post('/store', 'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents', 'MenuElementController@getParents');
            Route::get('/edit', 'MenuElementController@edit')->name('menu.edit');
            Route::post('/update', 'MenuElementController@update')->name('menu.update');
            Route::get('/show', 'MenuElementController@show')->name('menu.show');
            Route::get('/delete', 'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('menu.menu.index');
            Route::get('/create', 'MenuController@create')->name('menu.menu.create');
            Route::post('/store', 'MenuController@store')->name('menu.menu.store');
            Route::get('/edit', 'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update', 'MenuController@update')->name('menu.menu.update');
            Route::get('/delete', 'MenuController@delete')->name('menu.menu.delete');
        });

    });
});
