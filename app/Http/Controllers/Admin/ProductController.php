<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller{
    public function allProduct(){
        $products = (new ManageInfoService())->getProductInformation(null);
        return view('admin.product.all_product',compact('products'));
    }

    public function addProductForm(){
        $categories = (new ManageInfoService())->getCategoryInformation(null);
        $units = (new ManageInfoService())->getUnitInformation(null);
        $suppliers = (new ManageInfoService())->getSupplierInformation(null);
        return view('admin.product.add_product',compact('suppliers','units','categories'));
    }

    public function editProductForm($id){
        $categories = (new ManageInfoService())->getCategoryInformation(null);
        $units = (new ManageInfoService())->getUnitInformation(null);
        $suppliers = (new ManageInfoService())->getSupplierInformation(null);
        $product = (new ManageInfoService())->getProductInformation($id);
        return view('admin.product.edit_product',compact('product','suppliers','units','categories'));
    }

    public function insertProductFormSubmit(Request $request){

        $product_slug = uniqid('product-15');
        $created_by = Auth::user()->id;

        (new ManageInfoService())->insertProductInformation(
            $request['name'],
            $request['supplier_id'],
            $request['unit_id'],
            $request['category_id'],
            $request['quantity'],
            $product_slug,
            $created_by,
        );

        $notification = array(
            'message' => 'Product Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_product')->with($notification);
    }

    public function updateProductFormSubmit(Request $request){

        $product_slug = uniqid('product-15');
        $updated_by = Auth::user()->id;

        (new ManageInfoService())->updateProductInformation(
            $request['id'],
            $request['name'],
            $request['supplier_id'],
            $request['unit_id'],
            $request['category_id'],
            $request['quantity'],
            $product_slug,
            $updated_by,
        );

        $notification = array(
            'message' => 'Product Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_product')->with($notification);
    }

    public function deleteProduct($id){
        (new ManageInfoService())->deleteProductInformation($id);

        $notification = array(
            'message' => 'Product Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all_product')->with($notification);
    }
}
