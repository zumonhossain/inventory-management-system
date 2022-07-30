<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\AjaxController;


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
    

    // Unit
    Route::get('/unit/all-unit',[UnitController::class,'allUnit'])->name('all_unit');
    Route::get('/unit/add-unit-form',[UnitController::class,'addUnitForm'])->name('add_unit');
    Route::post('/unit/insert-new-unit',[UnitController::class,'insertUnitFormSubmit'])->name('insert_unit');
    Route::get('/unit/edit-unit/{id}',[UnitController::class,'editUnitForm'])->name('edit_unit');
    Route::post('/unit/update-unit',[UnitController::class,'updateUnitFormSubmit'])->name('update_unit');
    Route::get('/unit/delete-unit/{id}',[UnitController::class,'deleteUnit'])->name('delete_unit');

    // Category
    Route::get('/category/all-category',[CategoryController::class,'allCategory'])->name('all_category');
    Route::get('/category/add-category-form',[CategoryController::class,'addCategoryForm'])->name('add_category');
    Route::post('/category/insert-new-category',[CategoryController::class,'insertCategoryFormSubmit'])->name('insert_category');
    Route::get('/category/edit-category/{id}',[CategoryController::class,'editCategoryForm'])->name('edit_category');
    Route::post('/category/update-category',[CategoryController::class,'updateCategoryFormSubmit'])->name('update_category');
    Route::get('/category/delete-category/{id}',[CategoryController::class,'deleteCategory'])->name('delete_category');
    
    // Product
    Route::get('/product/all-product',[ProductController::class,'allProduct'])->name('all_product');
    Route::get('/product/add-product-form',[ProductController::class,'addProductForm'])->name('add_product');
    Route::post('/product/insert-new-product',[ProductController::class,'insertProductFormSubmit'])->name('insert_product');
    Route::get('/product/edit-product/{id}',[ProductController::class,'editProductForm'])->name('edit_product');
    Route::post('/product/update-product',[ProductController::class,'updateProductFormSubmit'])->name('update_product');
    Route::get('/product/delete-product/{id}',[ProductController::class,'deleteProduct'])->name('delete_product');
    
    // Purchase
    Route::get('/purchase/all-purchase',[PurchaseController::class,'allPurchase'])->name('all_purchase');
    Route::get('/purchase/add-purchase-form',[PurchaseController::class,'addPurchaseForm'])->name('add_purchase');
    
    // AjaxAllRouteCode
    Route::get('/get-category',[AjaxController::class,'getCategory'])->name('get-category');
    Route::get('/get-product',[AjaxController::class,'getProduct'])->name('get-product');
    
});










require __DIR__.'/auth.php';
