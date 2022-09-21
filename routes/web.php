<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormRequestController;

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

// Route::get('/', function () {
//     return view('login');
// });

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('login', 'postLogin');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware(['admin'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('dashboard', 'adminHome')->name('dashboard');
        Route::get('user_list', 'usersList')->name('user_list');
        Route::post('register_user', 'postRegistration');
        Route::get('delete_user/{id}', 'deleteUser');

    });

});

Route::middleware(['user_check'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('home', 'userHome')->name('home');
        Route::post('user_profile', 'profileStore')->name('user_profile');
    });

});

Route::controller(FormRequestController::class)->group(function () {
    // Modal Create Route
    Route::get('create-modal/{id}', 'getCreateModalData');

    // Modal Edit Route
    Route::get('edit-modal/{form}/{id}', 'getEditModalData');

    // Modal view Route
    Route::get('view-modal/{form}/{id}', 'getViewModalData');

    // Modal delete Route
    Route::get('delete-modal/{data}/{id}', 'getDeleteModalData');
});