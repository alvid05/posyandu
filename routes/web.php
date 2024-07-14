<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'App\Http\Controllers\UsersController@home')->name('home');
Route::get('/blog/{slug}', 'App\Http\Controllers\Frontweb\HomeController@blog')->name('blog.slug');

// page menu front web
Route::get('/tutorial', 'App\Http\Controllers\Frontweb\MenuController@tutorial')->name('menu.tutorial');
Route::get('/blog', 'App\Http\Controllers\Frontweb\MenuController@blog')->name('menu.blog');
Route::get('/buku', 'App\Http\Controllers\Frontweb\MenuController@buku')->name('menu.buku');
Route::get('/about-us', 'App\Http\Controllers\Frontweb\MenuController@aboutUs')->name('menu.about-us');
Route::get('/contact-us', 'App\Http\Controllers\Frontweb\MenuController@contactUs')->name('menu.contact-us');


// dashboard
Route::group(['prefix' => '/panel/blog', 'middleware' => 'auth'], function () {
    // Categpry
    Route::get('/category', 'App\Http\Controllers\Dashboard\Blog\CategoryController@view')->name('view-blog-category');
    Route::get('/category/create', 'App\Http\Controllers\Dashboard\Blog\CategoryController@create')->name('create-blog-category');
    Route::post('/category/store', 'App\Http\Controllers\Dashboard\Blog\CategoryController@store')->name('store-blog-category');
    Route::get('/category/edit/{id}', 'App\Http\Controllers\Dashboard\Blog\CategoryController@edit')->name('edit-blog-category');
    Route::get('/category/print/{id}', 'App\Http\Controllers\Dashboard\Blog\CategoryController@print')->name('print-blog-category');
    Route::post('/category/update/{id}', 'App\Http\Controllers\Dashboard\Blog\CategoryController@update')->name('update-blog-category');
    Route::delete('/category/delete/{id}', 'App\Http\Controllers\Dashboard\Blog\CategoryController@delete')->name('delete-blog-category');
    // Tag
    Route::get('/tag', 'App\Http\Controllers\Dashboard\Blog\TagController@view')->name('view-blog-tag');
    Route::get('/tag/create', 'App\Http\Controllers\Dashboard\Blog\TagController@create')->name('create-blog-tag');
    Route::post('/tag/store', 'App\Http\Controllers\Dashboard\Blog\TagController@store')->name('store-blog-tag');
    Route::get('/tag/edit/{id}', 'App\Http\Controllers\Dashboard\Blog\TagController@edit')->name('edit-blog-tag');
    Route::post('/tag/update/{id}', 'App\Http\Controllers\Dashboard\Blog\TagController@update')->name('update-blog-tag');
    Route::delete('/tag/delete/{id}', 'App\Http\Controllers\Dashboard\Blog\TagController@delete')->name('delete-blog-tag');
    // Post
    Route::get('/post', 'App\Http\Controllers\Dashboard\Blog\PostController@view')->name('view-blog-post');
    Route::get('/post/create', 'App\Http\Controllers\Dashboard\Blog\PostController@create')->name('create-blog-post');
    Route::post('/post/store', 'App\Http\Controllers\Dashboard\Blog\PostController@store')->name('store-blog-post');
    Route::get('/post/edit/{id}', 'App\Http\Controllers\Dashboard\Blog\PostController@edit')->name('edit-blog-post');
    Route::post('/post/update/{id}', 'App\Http\Controllers\Dashboard\Blog\PostController@update')->name('update-blog-post');
    Route::delete('/post/delete/{id}', 'App\Http\Controllers\Dashboard\Blog\PostController@delete')->name('delete-blog-post');
});



Route::get('/admin/login', 'App\Http\Controllers\UsersController@login')->name('login');
//Route::get('/panel/register', 'App\Http\Controllers\UsersController@register')->name('register');
//Route::post('/panel/registering', 'App\Http\Controllers\UsersController@registering')->name('registering');
Route::post('/panel/logining', 'App\Http\Controllers\UsersController@logining')->name('logining');

Route::group(['prefix' => config('app.admin_page'), 'middleware' => 'auth'], function () {
    Route::group(['prefix' => '/panel/dashboard'], function () {
        Route::match(['get', 'post'],'/', 'App\Http\Controllers\UsersController@dashboard')->name('view-dashboard');
        Route::match(['get', 'post'],'/profile', 'App\Http\Controllers\UsersController@profile')->name('view-profile');
        Route::get('/loging-out', 'App\Http\Controllers\UsersController@logingout')->name('logout');
        Route::get('/setting', 'App\Http\Controllers\Dashboard\UsersController@setting')->name('view-setting-dashboard');
    });

    Route::group(['prefix' => '/panel/assesment'], function () {
        Route::get('/',[\App\Http\Controllers\Dashboard\AssesmentController::class,'index'])->name('view-assesment');
        Route::post('/add',[\App\Http\Controllers\Dashboard\AssesmentController::class,'create'])->name('add-assesment');
        Route::post('/create',[\App\Http\Controllers\Dashboard\AssesmentController::class,'add'])->name('create-assesment');
        Route::post('/upload',[\App\Http\Controllers\Dashboard\AssesmentController::class,'upload'])->name('upload-assesment');
        Route::post('/update',[\App\Http\Controllers\Dashboard\AssesmentController::class,'update'])->name('update-assesment');
        Route::get('/delete/{id}',[\App\Http\Controllers\Dashboard\AssesmentController::class,'delete'])->name('delete-assesment');
        Route::get('/aggree/{id}',[\App\Http\Controllers\Dashboard\AssesmentController::class,'aggree'])->name('aggree-assesment');
        Route::match(['post','get'],'/disagree/{id}',[\App\Http\Controllers\Dashboard\AssesmentController::class,'disagree'])->name('
        ');
    });

    Route::group(['prefix' => '/panel/laporan'], function () {
        Route::match(['get', 'post'],'/add', 'App\Http\Controllers\Dashboard\LaporanController@add')->name('add-laporan');
        Route::post('/edit',[\App\Http\Controllers\Dashboard\LaporanController::class,'edit'])->name('edit-laporan');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Dashboard\LaporanController@delete')->name('delete-laporan');
    });

    Route::group(['prefix' => '/panel/schedule'], function () {
        Route::match(['get','post'],'/',[\App\Http\Controllers\Dashboard\ScheduleController::class,'index'])->name('schedule.index');
        Route::post('/request',[\App\Http\Controllers\Dashboard\ScheduleController::class,'request'])->name('schedule.request');
        Route::get('/approval/{id}',[\App\Http\Controllers\Dashboard\ScheduleController::class,'approval'])->name('schedule.approval');
        Route::post('/reject',[\App\Http\Controllers\Dashboard\ScheduleController::class,'reject'])->name('schedule.reject');
        Route::get('/delete/{id}',[\App\Http\Controllers\Dashboard\ScheduleController::class,'delete'])->name('schedule.delete');
    });

    Route::group(['prefix' => '/panel/audit'], function () {
        Route::get('/view', 'App\Http\Controllers\Dashboard\AuditController@index')->name('view-audit');
        Route::match(['get', 'post'],'/add', 'App\Http\Controllers\Dashboard\AuditController@add')->name('add-audit');
        Route::match(['get', 'post'],'/edit/{id}', 'App\Http\Controllers\Dashboard\AuditController@edit')->name('edit-audit');
        Route::delete('/delete/{id}', 'App\Http\Controllers\Dashboard\AuditController@delete')->name('delete-audit');
    });

    Route::group(['prefix' => '/panel/ums'], function () {
        Route::get('/role', 'App\Http\Controllers\Dashboard\RolesController@view')->name('view-ums-role');
        Route::get('/role/create', 'App\Http\Controllers\Dashboard\RolesController@create')->name('create-ums-role');
        Route::post('/role/store', 'App\Http\Controllers\Dashboard\RolesController@store')->name('store-ums-role');
        Route::get('/role/edit/{id}', 'App\Http\Controllers\Dashboard\RolesController@edit')->name('edit-ums-role');
        Route::post('/role/update/{id}', 'App\Http\Controllers\Dashboard\RolesController@update')->name('update-ums-role');
        Route::delete('/role/delete/{id}', 'App\Http\Controllers\Dashboard\RolesController@delete')->name('delete-ums-role');

        Route::get('/users', 'App\Http\Controllers\Dashboard\UsersController@view')->name('view-ums-users');
        Route::get('/users/create', 'App\Http\Controllers\Dashboard\UsersController@create')->name('create-ums-users');
        Route::post('/users/store', 'App\Http\Controllers\Dashboard\UsersController@store')->name('store-ums-users');
        Route::get('/users/edit/{id}', 'App\Http\Controllers\Dashboard\UsersController@edit')->name('edit-ums-users');
        Route::post('/users/update/{id}', 'App\Http\Controllers\Dashboard\UsersController@update')->name('update-ums-users');
        Route::delete('/users/delete/{id}', 'App\Http\Controllers\Dashboard\UsersController@delete')->name('delete-ums-users');
        Route::get('/getAuditorsByCategory', [\App\Http\Controllers\Dashboard\UsersController::class,'getAuditorsByCategory'])->name('getAuditorsByCategory');
    });
});
Route::group(['prefix' => config('app.admin_page'), 'middleware' => 'auth'], function () {
    Route::get('/users/loging-out', 'App\Http\Controllers\UsersController@logingoutUser')->name('logout-user');
});
