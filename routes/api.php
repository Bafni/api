<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
//, 'middleware' =>'jwt.auth'

Route::group(['namespace' => 'Auth', 'prefix' => 'auth',], function () {
    Route::post('signup', 'RegisterController');
    Route::post('signin', 'LoginController');
    Route::post('reset-password', 'ResetPasswordController');
    Route::post('signout', 'SignOutController');
    Route::post('me', 'MeController')->middleware('jwt.auth');
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts' ], function () {
    Route::get('/', 'IndexController');
    Route::get('/{post}', 'ShowController');
        Route::group(['middleware' =>['api','jwt.auth'] ], function () {
            Route::post('/', 'StoreController');
            Route::post('/{post}', 'UpdateController');
    });
    /*Вище контролер можна зробити методом patch і обновляти
    без Зображення бо метод patch щось не хоче загружати файли*/
      /*Route::post('/{post}', 'UploadImageController');*/
    /*тут окрема реалізація загрузки картинки але
    // вище контроллер мусить бути patch*/
});
Route::group(['namespace' => 'Taxonomy', 'prefix' => 'taxonomy'], function () {
    Route::get('/', 'IndexController');
    Route::get('/{taxonomy}', 'ShowController');
    Route::post('/', 'StoreController');
    Route::patch('/{taxonomy}', 'UpdateController');
});
Route::group(['namespace' => 'Mail', 'prefix' => 'mail'], function () {
    Route::post('/', 'MailController')->name('send_mail');
});
Route::group(['namespace' => 'Setting', 'prefix' => 'setting'], function () {
    Route::get('/', 'IndexController');
    Route::get('/{setting}', 'ShowController');
    Route::post('/', 'StoreController');
    Route::patch('/{setting}', 'UpdateController');

});
