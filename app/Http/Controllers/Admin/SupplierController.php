<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use Auth;

class SupplierController extends Controller{
    public function allSupplier(){
        $suppliers = (new ManageInfoService())->getSupplierInformation(null);
        return view('admin.supplier.all_supplier',compact('suppliers'));
    }

    public function addSupplierForm(){
        return view('admin.supplier.add_supplier');
    }

    public function editSupplierForm($id){
        $supplier = (new ManageInfoService())->getSupplierInformation($id);
        return view('admin.supplier.edit_supplier',compact('supplier'));
    }

    public function insertSupplierFormSubmit(Request $request){

        $supplier_slug = uniqid('supplier-15');
        $created_by = Auth::user()->id;

        (new ManageInfoService())->insertSupplierInformation(
            $request['name'],
            $request['mobile_no'],
            $request['email'],
            $request['address'],
            $supplier_slug,
            $created_by,
        );

        $notification = array(
            'message' => 'Supplier Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_supplier')->with($notification);
    }

    public function updateSupplierFormSubmit(Request $request){

        $supplier_slug = uniqid('supplier-15');
        $updated_by = Auth::user()->id;

        (new ManageInfoService())->updateSupplierInformation(
            $request['id'],
            $request['name'],
            $request['mobile_no'],
            $request['email'],
            $request['address'],
            $supplier_slug,
            $updated_by,
        );

        $notification = array(
            'message' => 'Supplier Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_supplier')->with($notification);
    }

    public function deleteSupplier($id){
        (new ManageInfoService())->deleteSupplierInformation($id);

        $notification = array(
            'message' => 'Supplier Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all_supplier')->with($notification);
    }
}
