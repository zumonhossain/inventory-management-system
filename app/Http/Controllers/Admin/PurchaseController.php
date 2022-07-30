<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;

class PurchaseController extends Controller{
    public function allPurchase(){
        return view('admin.purchase.all_purchase');
    }

    public function addPurchaseForm(){
        $suppliers = (new ManageInfoService())->getSupplierInformation(null);
        return view('admin.purchase.add_purchase',compact('suppliers'));
    }
}
