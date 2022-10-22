<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomSetupController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\AccountsReportController;
use App\Http\Controllers\GetAjaxRequestController;
use App\Http\Controllers\CarServiceRequestController;
use App\Http\Controllers\ReturnItemsController;
use App\Http\Controllers\StoresTransactionController;
use App\Http\Controllers\SupplyReceivedController;
use App\Models\ReturnItems;

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

    // Services
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

    // Stores
    Route::controller(SupplierController::class)->group(function () {
        Route::get('suppliers', 'index')->name('suppliers');
        Route::post('store_supplier', 'store');
        Route::get('delete_supplier/{id}', 'destroy');

    });

    Route::controller(ItemController::class)->group(function () {
        Route::get('items', 'index')->name('items');
        Route::post('store_item', 'store');
        Route::get('delete_item/{id}', 'destroy');
    });

    Route::controller(StoresTransactionController::class)->group(function () {
        Route::get('stores_transactions', 'index')->name('stores_transactions');
        Route::post('store_transaction', 'store');
        Route::get('print_invoice/{id}', 'printInvoice');
        Route::post('store_payment', 'storePayment');
        Route::get('transactions_payments', 'transactionsPayments')->name('transactions_payments');
        Route::get('print_receipt/{id}', 'printReceipt');
        Route::get('delete_transaction/{id}', 'destroy');
        Route::get('delete_transaction_receipt/{id}', 'destroyTransactionReceipt');
    });

    Route::controller(SupplyReceivedController::class)->group(function () {
        Route::get('supplies_received', 'index')->name('supplies_received');
        Route::post('store_supply', 'store');
        Route::get('delete_supply/{id}', 'destroy');
    });

    Route::controller(ReturnItemsController::class)->group(function () {
        Route::get('return_items', 'index')->name('return_items');
        Route::post('store_return', 'store');
        Route::get('delete_return/{id}', 'destroy');
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
    Route::get('get-item-info', 'getItemInfo');

});

// Receipt Route
Route::get('receipt/{request}/{data}', [CarServiceRequestController::class, 'getReceipt']);
Route::get('reprint_receipt/{id}', [CarServiceRequestController::class, 'reprintReceipt']);