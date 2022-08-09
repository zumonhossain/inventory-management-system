<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Purchase;
use DateTime;
use DateTimeZone;

class ReportController extends Controller{

    // All Invoice List
    public function reportInvoiceList(){
        $invoice = Invoice::where('invoice_status',1)->orderBy('date','desc')->orderBy('id','desc')->get();
        return view('admin.report.invoice.report_invoice_list',compact('invoice'));
    }

    public function reportInvoice($id){
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka')); 
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id',$invoice->id)->first();
        return view('admin.report.invoice.report_invoice',compact('invoice','payment','date'));
    }

    // Daily Invoice Report
    public function dailyInvoiceReportForm(){
        return view('admin.report.invoice.daily_nvoice_report_form');
    }

    public function dailyInvoiceReport(Request $request){

        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
         
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('invoice_status','1')->get();


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        return view('admin.report.invoice.daily_nvoice_report',compact('allData','start_date','end_date','date'));
    }


    // Stock Report
    public function allStockReport(){
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('admin.report.stock.all_stock_report',compact('allData'));
    }

    public function stockReport(){
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('admin.report.stock.stock_report',compact('allData','date'));
    }


    // Stock Supplier / Product Report
    public function stockSupplierProductReportForm(){
        $supppliers = Supplier::all();
        $category = Category::all();
        return view('admin.report.stock.stock_supplier_product_report_form',compact('supppliers','category'));
    }

    public function supplierWiseStockReport(Request $request){
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
        return view('admin.report.stock.supplier_wise_stock_report',compact('allData','date'));
    }

    public function productWiseStockReport(Request $request){
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $product = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
        return view('admin.report.stock.product_wise_stock_report',compact('product','date'));
    }
    
    public function dailyPurchaseReportForm(){
        return view('admin.report.purchase.daily_purchase_report_form');
    }

    public function dailyPurchaseReport(Request $request){
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('purchase_status','1')->get();


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));

        return view('admin.report.purchase.daily_purchase_report',compact('allData','start_date','end_date','date'));
    }

    // Credit Customer Report Form
    public function creditCustomerReportForm(){
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.report.customer.credit_customer_report_form',compact('allData'));
    }

    public function allCreditCustomerReport(){
        $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.report.customer.all_credit_customer_report',compact('allData','date'));
    }
}
