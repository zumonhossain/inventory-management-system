<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
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
}
