<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

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

        // Page editing
        Route::get('/interactive/start', 'PageEditor@start')->name('start.editing');
        Route::get('/interactive/stop', 'PageEditor@stop')->name('stop.editing');
        Route::post('/interactive/{page}/save', 'PageEditor@save');
    });

Route::get('/{page_path}', 'PageController@show')->name('page')->where('page_path', '.+');