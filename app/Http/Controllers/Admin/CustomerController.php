<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
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

        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        (new ManageInfoService())->insertCustomerInformation(
            $request['name'],
            $save_url,
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

        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
        Image::make($image)->resize(200,200)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        (new ManageInfoService())->updateCustomerInformation(
            $request['id'],
            $request['name'],
            $save_url,
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
