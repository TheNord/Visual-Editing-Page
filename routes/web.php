<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'PageController@showHome');

Route::get('/admin', 'Admin\AdminController@index')->name('home');

Route::get('/admin/pages', 'Admin\AdminController@index')->name('home');

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'can:admin-panel'],
    ],
    function () {
        // image uploads (in text redactor)
        Route::post('/ajax/upload/image', 'UploadController@image')->name('ajax.upload.image');
        Route::post('/ajax/upload/imagePage', 'UploadController@imagePage')->name('ajax.upload.imagePage');

        Route::get('/', 'AdminController@index')->name('home');

        // Admin >> Pages
        Route::resource('pages', 'PageController');

        // Admin >> Menu
        Route::resource('menu', 'MenuController');

        // Admin >> Settings
        Route::get('/settings', 'Settings\SettingController@index')->name('settings.index');
        Route::get('/settings/homepage', 'Settings\SettingController@changeHome')->name('settings.homePage');
        Route::put('/settings/homepage', 'Settings\SettingController@updateHome')->name('settings.updateHomePage');

        // Page editing
        Route::get('/interactive/start', 'PageEditor@start')->name('start.editing');
        Route::get('/interactive/stop', 'PageEditor@stop')->name('stop.editing');
        Route::post('/interactive/{page}/save', 'PageEditor@save');

        // Menu change position
        Route::group(['prefix' => 'menu/{menu}', 'as' => 'menu.'], function () {
            Route::post('/first', 'MenuController@first')->name('first');
            Route::post('/up', 'MenuController@up')->name('up');
            Route::post('/down', 'MenuController@down')->name('down');
            Route::post('/last', 'MenuController@last')->name('last');
        });
    });

Route::get('/{page_path}', 'PageController@show')->name('page')->where('page_path', '.+');