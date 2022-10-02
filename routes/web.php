<?php

use App\Http\Controllers\AccountsReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarServiceRequestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomSetupController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\GetAjaxRequestController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\StaffController;

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

    Route::controller(CustomSetupController::class)->group(function () {
        Route::get('custom_setups', 'index')->name('custom_setups');
        Route::post('store_custom', 'store');
        Route::get('delete_custom/{id}', 'destroy');

    });

    Route::controller(StaffController::class)->group(function () {
        Route::get('staffs', 'index')->name('staffs');
        Route::post('store_staff', 'store');
        Route::get('delete_staff/{id}', 'destroy');

    });
});

Route::middleware(['user_check'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('home', 'userHome')->name('home');
        Route::post('user_profile', 'profileStore')->name('user_profile');

    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'index')->name('customers');
        Route::post('store_customer', 'store');
        Route::get('delete_customer/{id}', 'destroy');

    });

    Route::controller(CarServiceRequestController::class)->group(function () {
        Route::get('services', 'index')->name('services');
        Route::get('service_transactions', 'serviceTransactions')->name('service_transactions');
        Route::post('store_service', 'store');
        Route::post('service_payment', 'servicePayment');
        Route::get('delete_service/{id}', 'destroy');

    });

    Route::controller(RentController::class)->group(function () {
        Route::get('rents', 'index')->name('rents');
        Route::post('store_rent', 'store');
        Route::get('delete_rent/{id}', 'destroy');

    });

    Route::controller(ExpenditureController::class)->group(function () {
        Route::get('expenditures', 'index')->name('expenditures');
        Route::post('store_expenditure', 'store');
        Route::get('delete_expenditure/{id}', 'destroy');

    });

    Route::controller(AccountsReportController::class)->group(function () {
        Route::get('accounts_reports', 'accountsReports')->name('accounts_reports');
        Route::get('income_statement', 'incomeStatement')->name('income_statement');
        Route::get('debtors', 'debtorListReport')->name('debtors');
        Route::get('specific_car', 'specificCarReport')->name('specific_car');
        Route::post('income_accounts_report', 'incomeAccountsReport')->name('income_accounts_report');
        
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

Route::controller(GetAjaxRequestController::class)->group(function () {
    Route::get('get-car-info', 'getCarInfo');
    Route::get('car-info', 'getCarInfoServices');

});

// Receipt Route
Route::get('receipt/{request}/{data}', [CarServiceRequestController::class, 'getReceipt']);
Route::get('reprint_receipt/{id}', [CarServiceRequestController::class, 'reprintReceipt']);