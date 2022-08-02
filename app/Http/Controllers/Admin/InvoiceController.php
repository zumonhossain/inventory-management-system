<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;

class InvoiceController extends Controller{
    public function allInvoice(){
        return view('admin.invoice.all_invoice');
    }

    public function addInvoiceForm(){
        $numberOfInvoiceNo = (new ManageInfoService())->createInvoiceNo();
        $customers = (new ManageInfoService())->getCustomerInformation(null);
        $categories = (new ManageInfoService())->getCategoryInformation(null);
        return view('admin.invoice.add_invoice',compact('categories','customers','numberOfInvoiceNo'));
    }

    public function insertInvoiceFormSubmit(Request $request){
        // dd($request->all());
        (new ManageInfoService())->insertInvoiceInformation(

        );
    }
}
