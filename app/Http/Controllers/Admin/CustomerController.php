<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use App\Http\Controllers\Helpers\FileUploadController;
use Illuminate\Http\Request;
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


    
}
