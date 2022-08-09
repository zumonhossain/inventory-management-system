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
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ReportController;


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

    Route::get('/credit/customer',[CustomerController::class,'creditCustomer'])->name('credit_customer');
    Route::get('/edit/customer/invoice/{invoice_id}',[CustomerController::class,'editCustomerInvoice'])->name('edit_customer_invoice');
    Route::post('/customer/update/invoice/{invoice_id}',[CustomerController::class,'updateCustomerInvoice'])->name('customer_update_invoice');
    Route::get('/customer/invoice/details/{invoice_id}',[CustomerController::class,'customerInvoiceDetails'])->name('customer_invoice_details');
    Route::get('/paid/customer',[CustomerController::class,'paidCustomer'])->name('paid_customer');
    
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
    Route::post('/purchase/insert-new-purchase',[PurchaseController::class,'insertPurchaseFormSubmit'])->name('insert_purchase');
    Route::get('/purchase/delete-purchase/{id}',[PurchaseController::class,'deletePurchase'])->name('delete_purchase');
    Route::get('/purchase/pending-purchase',[PurchaseController::class,'pendingPurchase'])->name('pending_purchase');
    Route::get('/purchase/approve-purchase/{id}',[PurchaseController::class,'approvePurchase'])->name('approve_purchase');
    // AjaxPurchaseRouteCode
    Route::get('/get-category',[AjaxController::class,'getCategory'])->name('get-category');
    Route::get('/get-product',[AjaxController::class,'getProduct'])->name('get-product');

    // Invoice
    Route::get('/invoice/all-invoice',[InvoiceController::class,'allInvoice'])->name('all_invoice');
    Route::get('/invoice/add-invoice-form',[InvoiceController::class,'addInvoiceForm'])->name('add_invoice');
    Route::post('/invoice/insert-new-invoice',[InvoiceController::class,'insertInvoiceFormSubmit'])->name('insert_invoice');

    Route::get('/invoice/pending-invoice',[InvoiceController::class,'pendingInvoice'])->name('pending_invoice');
    Route::get('/invoice/delete-invoice/{id}',[InvoiceController::class,'deleteInvoice'])->name('delete_invoice');
    Route::get('/invoice/approve-invoice/{id}',[InvoiceController::class,'approveInvoice'])->name('approve_invoice');

    Route::post('/invoice/insert-approve-invoice/{id}',[InvoiceController::class,'insertApproveInvoiceFormSubmit'])->name('insert_approve_invoice');
    // AjaxInvoiceRouteCode
    Route::get('/check-stock',[AjaxController::class,'getStock'])->name('check-product-stock');



    // Report Invoice
    Route::get('/report/invoice/list',[ReportController::class,'reportInvoiceList'])->name('report_invoice_list');
    Route::get('/report/invoice/{id}',[ReportController::class,'reportInvoice'])->name('report_invoice');
    Route::get('/daily/invoice/report/form',[ReportController::class,'dailyInvoiceReportForm'])->name('daily_invoice_report_form');
    Route::get('/daily/invoice/report',[ReportController::class,'dailyInvoiceReport'])->name('daily_invoice_report');

    // Report Stock
    Route::get('/stock/report/all',[ReportController::class,'allStockReport'])->name('all_stock_report');
    Route::get('/stock/report',[ReportController::class,'stockReport'])->name('stock_report');
    Route::get('/stock/supplier/product/report/form',[ReportController::class,'stockSupplierProductReportForm'])->name('stock_supplier_product_report_form');
    Route::get('/stock/supplier/wise/report',[ReportController::class,'supplierWiseStockReport'])->name('supplier_wise_stock_report');
    Route::get('/stock/product/wise/report',[ReportController::class,'productWiseStockReport'])->name('product_wise_stock_report');

    // Report Daily Purchase
    Route::get('/daily/purchase/report/form',[ReportController::class,'dailyPurchaseReportForm'])->name('daily_purchase_report_form');
    Route::get('/daily/purchase/report',[ReportController::class,'dailyPurchaseReport'])->name('daily_purchase_report');

    //Credit Customer Report Form
    Route::get('/credit/customer/report/form',[ReportController::class,'creditCustomerReportForm'])->name('credit_customer_report_form');
    Route::get('/all/credit/customer/report',[ReportController::class,'allCreditCustomerReport'])->name('all_credit_customer_report');
    Route::get('/customer/invoice/details/report/{invoice_id}',[ReportController::class,'customerInvoiceDetailsReport'])->name('customer_invoice_details_report');
    

    // Paid Customer Report Form
    Route::get('/paid/customer/report/form',[ReportController::class,'paidCustomerReportForm'])->name('paid_customer_report_form');
    
});










require __DIR__.'/auth.php';
