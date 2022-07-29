<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Unit;
use Carbon\Carbon;
use Auth;

class ManageInfoService extends Controller{

    /*=====================
            Supplier
    =====================*/
    public function getSupplierInformation($id){
        if($id == null){
            return Supplier::where('supplier_status', 1)->get();
        }else{
            return Supplier::where('supplier_status', 1)->where('supplier_id', $id)->first();
        }
    }

    public function insertSupplierInformation($name, $mobile_no, $email, $address, $supplier_slug, $created_by){
        return Supplier::insertGetId([
            'name' => $name,
            'mobile_no' => $mobile_no,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'supplier_slug' => $supplier_slug,
            'created_by' => $created_by,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateSupplierInformation($id, $name, $mobile_no, $email, $address, $supplier_slug, $updated_by){
        return Supplier::where('supplier_id', $id)->update([
            'name' => $name,
            'mobile_no' => $mobile_no,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'supplier_slug' => $supplier_slug,
            'updated_by' => $updated_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteSupplierInformation($id){
        return Supplier::where('supplier_id', $id)->update([
            'supplier_status' => 0
        ]);
    }




    /*=====================
            Customer
    =====================*/
    public function getCustomerInformation($id){
        if($id == null){
            return Customer::where('customer_status', 1)->get();
        }else{
            return Customer::where('customer_status', 1)->where('customer_id', $id)->first();
        }
    }

    public function insertCustomerInformation($name, $customer_image, $mobile_no, $email, $address, $customer_slug, $created_by){
        return Customer::insertGetId([
            'name' => $name,
            'customer_image' => $customer_image,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'customer_slug' => $customer_slug,
            'created_by' => $created_by,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateCustomerInformation($id, $name, $customer_image, $mobile_no, $email, $address, $customer_slug, $updated_by){
        return Customer::where('customer_id', $id)->update([
            'name' => $name,
            'customer_image' => $customer_image,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'customer_slug' => $customer_slug,
            'updated_by' => $updated_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteCustomerInformation($id){
        return Customer::where('customer_id', $id)->update([
            'customer_status' => 0
        ]);
    }



    /*=====================
            Unit
    =====================*/
    public function getUnitInformation($id){
        if($id == null){
            return Unit::where('unit_status', 1)->get();
        }else{
            return Unit::where('unit_status', 1)->where('unit_id', $id)->first();
        }
    }

    public function insertUnitInformation($name, $unit_slug, $created_by){
        return Unit::insertGetId([
            'name' => $name,
            'unit_slug' => $unit_slug,
            'created_by' => $created_by,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateUnitInformation($id, $name, $unit_slug, $updated_by){
        return Unit::where('unit_id', $id)->update([
            'name' => $name,
            'unit_slug' => $unit_slug,
            'updated_by' => $updated_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteUnitInformation($id){
        return Unit::where('unit_id', $id)->update([
            'unit_status' => 0
        ]);
    }




}
