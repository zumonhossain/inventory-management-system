<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Auth;
use DB;

class InvoiceController extends Controller{
    public function allInvoice(){
        $invoice = (new ManageInfoService())->getInvoiceInformation(null);
        return view('admin.invoice.all_invoice',compact('invoice'));
    }

    public function addInvoiceForm(){
        $categories = Category::all();
        $customers = Customer::all();
        $invoice_data = Invoice::orderBy('invoice_id','desc')->first();
        if ($invoice_data == null) {
           $firstReg = '0';
           $invoice_no = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('invoice_id','desc')->first()->invoice_no;
            $invoice_no = $invoice_data+1;
        }
        $date = date('Y-m-d');
        return view('admin.invoice.add_invoice',compact('invoice_no','categories','date','customers'));
    }

    public function insertInvoiceFormSubmit(Request $request){

        //dd($request->all());

        if ($request->category_id == null) {
    
            $notification = array(
                'message' => 'Sorry You do not select any item', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
    
        }else{

            if ($request->paid_amount > $request->estimated_amount) {
    
                $notification = array(
                    'message' => 'Sorry Paid Amount is Maximum the total price', 
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
    
            }else{
    
                $date = date('Y-m-d');
                $created_by = Auth::user()->id;

                $invoice = Invoice::insertGetId([
                    'invoice_no'=>$request['invoice_no'],
                    'date'=>$date,
                    'description'=>$request['description'],
                    'invoice_status'=>'0',
                    'created_by'=> $created_by,
                    'created_at'=>carbon::now(),
                ]);

                $count_category = count($request->category_id);

                for ($i=0; $i < $count_category ; $i++) {
                    
                    $invoiceDetails = InvoiceDetail::insertGetId([
                        'date'=>$date,
                        'invoice_id'=>$invoice,
                        'category_id'=>$request['category_id'][$i],
                        'product_id'=>$request['product_id'][$i],
                        'selling_qty'=>$request['selling_qty'][$i],
                        'unit_price'=>$request['unit_price'][$i],
                        'selling_price'=>$request['selling_price'][$i],
                        'invoice_detail_status'=>'0',
                        'created_at'=>carbon::now(),
                    ]);

                };

                if ($request->customer_id == '0') {
                    $customer = Customer::insertGetId([
                        'name'=>$request['name'],
                        'mobile_no'=>$request['mobile_no'],
                        'email'=>$request['email'],
                        'created_by'=> $created_by,
                        'created_at'=>carbon::now(),
                    ]);
                }
                else{
                    $customer_id = $request->customer_id;
                } 
            
                $payment = new Payment();
                $payment_details = new PaymentDetail();
    
                $payment->invoice_id = $invoice;
                $payment->customer_id = $request->customer_id;
                $payment->paid_status = $request->paid_status;
                $payment->discount_amount = $request->discount_amount;
                $payment->total_amount = $request->estimated_amount;
    
                if($request->paid_status == 'full_paid') {
                    $payment->paid_amount = $request->estimated_amount;
                    $payment->due_amount = '0';
                    $payment_details->current_paid_amount = $request->estimated_amount;
                }
                elseif($request->paid_status == 'full_due'){
                    $payment->paid_amount = '0';
                    $payment->due_amount = $request->estimated_amount;
                    $payment_details->current_paid_amount = '0';
                }
                elseif($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
                }

                $payment->save();
    
                $payment_details->invoice_id = $invoice; 
                $payment_details->date = $date;
                
                $payment_details->save(); 
            }
        }

        $notification = array(
            'message' => 'Invoice Data Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all_invoice')->with($notification);  
    } 

}
