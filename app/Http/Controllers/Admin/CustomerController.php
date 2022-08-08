<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use App\Http\Controllers\Helpers\FileUploadController;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\InvoiceDetail;
use App\Models\PaymentDetail;
use Image;
use Auth;

class CustomerController extends Controller{
    public function allCustomer(){
        $customers = (new ManageInfoService())->getCustomerInformation(null);
        return view('admin.customer.all_customer',compact('customers'));
    }

    public function addCustomerForm(){
        return view('admin.customer.add_customer');
    }

    public function editCustomerForm($id){
        $customer = (new ManageInfoService())->getCustomerInformation($id);
        return view('admin.customer.edit_customer',compact('customer'));
    }

    public function insertCustomerFormSubmit(Request $request){

        $customer_slug = uniqid('customer-15');
        $created_by = Auth::user()->id;

        $customerImagePath = (new FileUploadController())->uploadCustomerImage($request);

        (new ManageInfoService())->insertCustomerInformation(
            $request['name'],
            $customerImagePath,
            $request['mobile_no'],
            $request['email'],
            $request['address'],
            $customer_slug,
            $created_by
        );

        $notification = array(
            'message' => 'Customer Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_customer')->with($notification);
    }

    public function updateCustomerFormSubmit(Request $request){

        $customer_slug = uniqid('customer-15');
        $updated_by = Auth::user()->id;

        $customerImagePath = (new FileUploadController())->uploadCustomerImage($request);

        (new ManageInfoService())->updateCustomerInformation(
            $request['id'],
            $request['name'],
            $customerImagePath,
            $request['mobile_no'],
            $request['email'],
            $request['address'],
            $customer_slug,
            $updated_by
        );

        $notification = array(
            'message' => 'Customer Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_customer')->with($notification);
    }

    public function deleteCustomer($id){
        (new ManageInfoService())->deleteCustomerInformation($id);

        $notification = array(
            'message' => 'Customer Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all_customer')->with($notification);
    }

    
    // Credit Customer
    public function creditCustomer(){
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.customer.credit_customer',compact('allData'));
    }

    // Edit Customer Invoice
    public function editCustomerInvoice($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        $invoice_details = InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
        return view('admin.customer.edit_customer_invoice',compact('invoice_details','payment'));
    }
    
    public function updateCustomerInvoice(Request $request,$invoice_id){
        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
                'message' => 'Sorry You Paid Maximum Value', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); 
        }
        else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $date = date('Y-m-d');

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = $date;
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

            $notification = array(
                'message' => 'Invoice Update Successfully', 
                'alert-type' => 'success'
            );

            return redirect()->route('credit_customer')->with($notification); 
        }
    }
}
