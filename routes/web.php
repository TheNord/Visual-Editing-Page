<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'PageController@showHome');

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
        Route::resource('pages', 'PageController')->except('show');

        // Admin >> Menu
        Route::resource('menu', 'MenuController')->except('show');

        // Admin >> Settings
        Route::get('/settings', 'Settings\SettingController@index')->name('settings.index');
        Route::get('/settings/homepage', 'Settings\SettingController@changeHome')->name('settings.homePage');
        Route::put('/settings/homepage', 'Settings\SettingController@updateHome')->name('settings.updateHomePage');

        // Admin >> Widgets
        Route::resource('/widgets', 'WidgetsController');

        // Admin >> TemplateManager
        Route::get('/template-manager', 'TemplateController@index')->name('template-manager.index');
        Route::post('/template-manager/update', 'TemplateController@update');
        Route::post('/template-manager/load', 'TemplateController@load');
        Route::post('/template-manager/explore', 'TemplateController@explore');
        Route::post('/template-manager/tree', 'TemplateController@tree');

        Route::group(['prefix' => 'posts', 'as' => 'posts.', 'namespace' => 'Posts'], function () {

            // Admin >> Posts
            Route::get('/', 'PostController@index')->name('index');
            Route::get('/{post}/edit', 'PostController@edit')->name('edit');
            Route::get('/create', 'PostController@create')->name('create');
            Route::post('/create', 'PostController@store')->name('store');
            Route::put('/{post}', 'PostController@update')->name('update');
            Route::delete('/{post}', 'PostController@destroy')->name('destroy');

            // Admin >> Posts >> Categories
            Route::get('/categories', 'CategoryController@index')->name('categories.index');
            Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
            Route::post('/categories', 'CategoryController@store')->name('categories.store');
            Route::put('/categories/{category}', 'CategoryController@update')->name('categories.update');
            Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

            // Admin >> Posts >> Tags
            Route::get('/tags', 'TagController@index')->name('tags.index');
            Route::get('/tags/{tag}/edit', 'TagController@edit')->name('tags.edit');
            Route::post('/tags', 'TagController@store')->name('tags.store');
            Route::put('/tags/{tag}', 'TagController@update')->name('tags.update');
            Route::delete('/tags/{tag}', 'TagController@destroy')->name('tags.destroy');
        });

        // Menu change position
        Route::group(['prefix' => 'menu/{menu}', 'as' => 'menu.'], function () {
            Route::post('/first', 'MenuController@first')->name('first');
            Route::post('/up', 'MenuController@up')->name('up');
            Route::post('/down', 'MenuController@down')->name('down');
            Route::post('/last', 'MenuController@last')->name('last');
        });
    });

/**
* Сheck for the existence of a category
* If category not found check existence of a page
*/
$path = explode('/', Request::path());
$firstPath = reset($path);

if (\App\Entity\Post\Category::where('slug', $firstPath)->first()) {
    Route::get('/{category}', 'PostController@category')->name('category');
    // Find category and post the current category
    Route::get('/{category}/{post}/', 'PostController@show')->name('category.post.show');
}

Route::get('/{page_path}', 'PageController@show')->name('page')->where('page_path', '.+');






