<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use Auth;

class PurchaseController extends Controller{
    public function allPurchase(){
        $purchases = (new ManageInfoService())->getPurchaseInformation(null);
        return view('admin.purchase.all_purchase',compact('purchases'));
    }

    public function addPurchaseForm(){
        $suppliers = (new ManageInfoService())->getSupplierInformation(null);
        return view('admin.purchase.add_purchase',compact('suppliers'));
    }

    public function insertPurchaseFormSubmit(Request $request){

        if ($request->category_id == null) {

            $notification = array(
                'message' => 'Sorry you do not select any item', 
                'alert-type' => 'error'
            );
            return redirect()->back( )->with($notification);
        } else {

            $purchase_slug = uniqid('purchase-15');
            $created_by = Auth::user()->id;

            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) { 
                (new ManageInfoService())->insertPurchaseInformation(
                    $request['date'][$i],
                    $request['purchase_no'][$i],
                    $request['supplier_id'][$i],
                    $request['category_id'][$i],
                    $request['product_id'][$i],
                    $request['buying_qty'][$i],
                    $request['unit_price'][$i],
                    $request['buying_price'][$i],
                    $request['description'][$i],
                    $purchase_slug,
                    $created_by,
                );
            }

            $notification = array(
                'message' => 'Data Save Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->route('all_purchase')->with($notification);
        }
    }    

    public function deletePurchase($id){
        (new ManageInfoService())->deletePurchaseInformation($id);

        $notification = array(
            'message' => 'Purchase Item Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function pendingPurchase(){
        $purchases = (new ManageInfoService())->getPurchaseInPendingInformation(null);
        return view('admin.purchase.pending_purchase',compact('purchases'));
    }

    public function approvePurchase($id){
        (new ManageInfoService())->approvePurchaseInformation($id);

        $notification = array(
            'message' => 'Status Approved Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all_purchase')->with($notification);
    }
}
