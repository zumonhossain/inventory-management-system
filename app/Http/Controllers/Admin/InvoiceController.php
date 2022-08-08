<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Customer;
use DB;

class InvoiceController extends Controller{
    public function allInvoice(){
        $invoice = Invoice::where('invoice_status',1)->orderBy('date','desc')->orderBy('id','desc')->get();
        return view('admin.invoice.all_invoice',compact('invoice'));
    }

    public function addInvoiceForm(){
        $categories = Category::all();
        $customers = Customer::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if ($invoice_data == null) {
           $firstReg = '0';
           $invoice_no = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
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
    
        } else{
            if ($request->paid_amount > $request->estimated_amount) {
    
               $notification = array(
            'message' => 'Sorry Paid Amount is Maximum the total price', 
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    
            } else {
    
        $date = date('Y-m-d');

        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = $date;
        $invoice->description = $request->description;
        $invoice->invoice_status = '0';
        $invoice->created_by = Auth::user()->id; 
    
        DB::transaction(function() use($request,$invoice){
            $date = date('Y-m-d');
            if ($invoice->save()) {
               $count_category = count($request->category_id);
               for ($i=0; $i < $count_category ; $i++) { 
    
                  $invoice_details = new InvoiceDetail();
                  $invoice_details->date = $date;
                  $invoice_details->invoice_id = $invoice->id;
                  $invoice_details->category_id = $request->category_id[$i];
                  $invoice_details->product_id = $request->product_id[$i];
                  $invoice_details->selling_qty = $request->selling_qty[$i];
                  $invoice_details->unit_price = $request->unit_price[$i];
                  $invoice_details->selling_price = $request->selling_price[$i];
                  $invoice_details->invoice_detail_status = '0'; 
                  $invoice_details->save(); 
               }
    
                if ($request->customer_id == '0') {
                    $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->mobile_no = $request->mobile_no;
                    $customer->email = $request->email;
                    $customer->save();
                    $customer_id = $customer->id;
                } else{
                    $customer_id = $request->customer_id;
                } 
    
                $payment = new Payment();
                $payment_details = new PaymentDetail();
    
                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $customer_id;
                $payment->paid_status = $request->paid_status;
                $payment->discount_amount = $request->discount_amount;
                $payment->total_amount = $request->estimated_amount;
    
                if ($request->paid_status == 'full_paid') {
                    $payment->paid_amount = $request->estimated_amount;
                    $payment->due_amount = '0';
                    $payment_details->current_paid_amount = $request->estimated_amount;
                } elseif ($request->paid_status == 'full_due') {
                    $payment->paid_amount = '0';
                    $payment->due_amount = $request->estimated_amount;
                    $payment_details->current_paid_amount = '0';
                }elseif ($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
                }
                $payment->save();
    
                $payment_details->invoice_id = $invoice->id; 
                $payment_details->date = $date;
                $payment_details->save(); 
            } 
    
                }); 
    
            } // end else 
        }
    
         $notification = array(
            'message' => 'Invoice Data Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('pending_invoice')->with($notification);  
        } 


    // public function insertInvoiceFormSubmit(Request $request){

    //     //dd($request->all());

    //     if ($request->category_id == null) {
    
    //         $notification = array(
    //             'message' => 'Sorry You do not select any item', 
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->back()->with($notification);
    
    //     }else{

    //         if ($request->paid_amount > $request->estimated_amount) {
    
    //             $notification = array(
    //                 'message' => 'Sorry Paid Amount is Maximum the total price', 
    //                 'alert-type' => 'error'
    //             );
    //             return redirect()->back()->with($notification);
    
    //         }else{
    
    //             $date = date('Y-m-d');
    //             $created_by = Auth::user()->id;

    //             $invoice = Invoice::insertGetId([
    //                 'invoice_no'=>$request['invoice_no'],
    //                 'date'=>$date,
    //                 'description'=>$request['description'],
    //                 'invoice_status'=>'0',
    //                 'created_by'=> $created_by,
    //                 'created_at'=>carbon::now(),
    //             ]);

    //             $count_category = count($request->category_id);

    //             for ($i=0; $i < $count_category ; $i++) {
                    
    //                 $invoiceDetails = InvoiceDetail::insertGetId([
    //                     'date'=>$date,
    //                     'invoice_id'=>$invoice,
    //                     'category_id'=>$request['category_id'][$i],
    //                     'product_id'=>$request['product_id'][$i],
    //                     'selling_qty'=>$request['selling_qty'][$i],
    //                     'unit_price'=>$request['unit_price'][$i],
    //                     'selling_price'=>$request['selling_price'][$i],
    //                     'invoice_detail_status'=>'0',
    //                     'created_at'=>carbon::now(),
    //                 ]);

    //             };

    //             if ($request->customer_id == '0') {
    //                 $customer = Customer::insertGetId([
    //                     'name'=>$request['name'],
    //                     'mobile_no'=>$request['mobile_no'],
    //                     'email'=>$request['email'],
    //                     'created_by'=> $created_by,
    //                     'created_at'=>carbon::now(),
    //                 ]);
    //             }
    //             else{
    //                 $customer_id = $request->customer_id;
    //             } 
            
    //             $payment = new Payment();
    //             $payment_details = new PaymentDetail();
    
    //             $payment->invoice_id = $invoice;
    //             $payment->customer_id = $request->customer_id;
    //             $payment->paid_status = $request->paid_status;
    //             $payment->discount_amount = $request->discount_amount;
    //             $payment->total_amount = $request->estimated_amount;
    
    //             if($request->paid_status == 'full_paid') {
    //                 $payment->paid_amount = $request->estimated_amount;
    //                 $payment->due_amount = '0';
    //                 $payment_details->current_paid_amount = $request->estimated_amount;
    //             }
    //             elseif($request->paid_status == 'full_due'){
    //                 $payment->paid_amount = '0';
    //                 $payment->due_amount = $request->estimated_amount;
    //                 $payment_details->current_paid_amount = '0';
    //             }
    //             elseif($request->paid_status == 'partial_paid') {
    //                 $payment->paid_amount = $request->paid_amount;
    //                 $payment->due_amount = $request->estimated_amount - $request->paid_amount;
    //                 $payment_details->current_paid_amount = $request->paid_amount;
    //             }

    //             $payment->save();
    
    //             $payment_details->invoice_id = $invoice; 
    //             $payment_details->date = $date;
                
    //             $payment_details->save(); 
    //         }
    //     }

    //     $notification = array(
    //         'message' => 'Invoice Data Inserted Successfully', 
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('pending_invoice')->with($notification);  
    // } 

    public function pendingInvoice(){
        $invoice = Invoice::where('invoice_status',0)->orderBy('id','desc')->get();
        return view('admin.invoice.pending_invoice',compact('invoice'));
    }

    public function deleteInvoice($id){

        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        InvoiceDetail::where('invoice_id',$invoice->id)->delete(); 
        Payment::where('invoice_id',$invoice->id)->delete(); 
        PaymentDetail::where('invoice_id',$invoice->id)->delete(); 

        $notification = array(
            'message' => 'Invoice Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function approveInvoice($id){
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id',$invoice->id)->first();
        return view('admin.invoice.approve_invoice',compact('invoice','payment'));
    }

    public function insertApproveInvoiceFormSubmit(Request $request, $id){

        foreach($request->selling_qty as $key => $val){

            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();

            if($product->quantity < $request->selling_qty[$key]){

                $notification = array(
                    'message' => 'Sorry you approve Maximum Value', 
                    'alert-type' => 'error'
                );
                
                return redirect()->back()->with($notification); 
            }
        } // End foreach 

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->invoice_status = '1';

        DB::transaction(function() use($request,$invoice,$id){
            foreach($request->selling_qty as $key => $val){
             $invoice_details = InvoiceDetail::where('id',$key)->first();

             $invoice_details->invoice_detail_status = '1';
             $invoice_details->save();

             $product = Product::where('id',$invoice_details->product_id)->first();

             $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);

             $product->save();
            } // end foreach

            $invoice->save();
        });

        $notification = array(
            'message' => 'Invoice Approve Successfully', 
            'alert-type' => 'success'
        );
        
        return redirect()->route('all_invoice')->with($notification);  
    }
    


}
