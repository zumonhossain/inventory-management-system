<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Auth;

class PurchaseController extends Controller{
    public function allPurchase(){
        return view('admin.purchase.all_purchase');
    }

    public function addPurchaseForm(){
        $suppliers = (new ManageInfoService())->getSupplierInformation(null);
        return view('admin.purchase.add_purchase',compact('suppliers'));
    }

    public function insertPurchaseFormSubmit(Request $request){

        if ($request->supplier_id == null) {
    
            $notification = array(
                'message' => 'Sorry you do not select any item', 
                'alert-type' => 'error'
            );
            return redirect()->back( )->with($notification);

        } else {
    
            $count_category = count($request->category_id);

            for ($i=0; $i < $count_category; $i++) { 
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
    
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
    
                $purchase->created_by = Auth::user()->id;
                $purchase->purchase_status = '0';
                $purchase->save();
            }
        }
    
        $notification = array(
            'message' => 'Data Save Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_purchase')->with($notification); 
    }    
}
