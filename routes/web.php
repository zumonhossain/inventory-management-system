<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CustomerController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');






// ================= Admin Routes ======================
Route::group(['prefix'=>'admin'], function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('/profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('/edit/profile',[AdminController::class,'editProfile'])->name('edit.profile');
    Route::post('/store/profile',[AdminController::class,'storeProfile'])->name('store.profile');
    Route::get('/change/password',[AdminController::class,'changePassword'])->name('change.password');
    Route::post('/update/password',[AdminController::class,'updatePassword'])->name('update.password');

    // Supplier
    Route::get('/supplier/all-supplier',[SupplierController::class,'allSupplier'])->name('all_supplier');
    Route::get('/supplier/add-supplier-form',[SupplierController::class,'addSupplierForm'])->name('supplier_add_form');
    Route::post('/supplier/insert-new-supplier',[SupplierController::class,'insertSupplierFormSubmit'])->name('supplier_insert_form');
    Route::get('/supplier/edit-supplier/{id}',[SupplierController::class,'editSupplierForm'])->name('supplier_edit_form');
    Route::post('/supplier/update-supplier',[SupplierController::class,'updateSupplierFormSubmit'])->name('supplier_update_form');
    Route::get('/supplier/delete-supplier/{id}',[SupplierController::class,'deleteSupplier'])->name('supplier_delete');

    // Customer
    Route::get('/customer/all-customer',[CustomerController::class,'allCustomer'])->name('all_customer');
    Route::get('/customer/add-customer-form',[CustomerController::class,'addCustomerForm'])->name('add_customer');
    Route::post('/customer/insert-new-customer',[CustomerController::class,'insertCustomerFormSubmit'])->name('insert_customer');
    Route::get('/customer/edit-customer/{id}',[CustomerController::class,'editCustomerForm'])->name('edit_customer');
    Route::post('/customer/update-customer',[CustomerController::class,'updateCustomerFormSubmit'])->name('update_customer');
    Route::get('/customer/delete-customer/{id}',[CustomerController::class,'deleteCustomer'])->name('delete_customer');
    
});










require __DIR__.'/auth.php';
