<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Auth;

class ManageInfoService extends Controller{
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

    public function updateSupplierInformation($id, $name, $mobile_no, $email, $address, $supplier_slug, $created_by){
        return Supplier::where('supplier_id', $id)->update([
            'name' => $name,
            'mobile_no' => $mobile_no,
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'supplier_slug' => $supplier_slug,
            'created_by' => $created_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteSupplierInformation($id){
        return Supplier::where('supplier_id', $id)->update([
            'supplier_status' => 0
        ]);
    }
}
