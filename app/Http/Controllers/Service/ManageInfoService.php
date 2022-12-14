<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Invoice;
use Carbon\Carbon;
use Auth;

class ManageInfoService extends Controller{

    /*
    =================================================================
    ========================== Supplier =============================
    =================================================================
    */

    public function getSupplierInformation($id){
        if($id == null){
            return Supplier::where('supplier_status', 1)->get();
        }else{
            return Supplier::where('supplier_status', 1)->where('id', $id)->first();
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
        return Supplier::where('id', $id)->update([
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
        return Supplier::where('id', $id)->update([
            'supplier_status' => 0
        ]);
    }


    /*
    =================================================================
    ========================== Customer =============================
    =================================================================
    */

    public function getCustomerInformation($id){
        if($id == null){
            return Customer::where('customer_status', 1)->get();
        }else{
            return Customer::where('customer_status', 1)->where('id', $id)->first();
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
        return Customer::where('id', $id)->update([
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
        return Customer::where('id', $id)->update([
            'customer_status' => 0
        ]);
    }



    /*
    =================================================================
    ============================ Unit ===============================
    =================================================================
    */

    public function getUnitInformation($id){
        if($id == null){
            return Unit::where('unit_status', 1)->get();
        }else{
            return Unit::where('unit_status', 1)->where('id', $id)->first();
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
        return Unit::where('id', $id)->update([
            'name' => $name,
            'unit_slug' => $unit_slug,
            'updated_by' => $updated_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteUnitInformation($id){
        return Unit::where('id', $id)->update([
            'unit_status' => 0
        ]);
    }


    /*
    =================================================================
    ========================== Category =============================
    =================================================================
    */

    public function getCategoryInformation($id){
        if($id == null){
            return Category::where('category_status', 1)->get();
        }else{
            return Category::where('category_status', 1)->where('id', $id)->first();
        }
    }

    public function insertCategoryInformation($name, $category_slug, $created_by){
        return Category::insertGetId([
            'name' => $name,
            'category_slug' => $category_slug,
            'created_by' => $created_by,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateCategoryInformation($id, $name, $category_slug, $updated_by){
        return Category::where('id', $id)->update([
            'name' => $name,
            'category_slug' => $category_slug,
            'updated_by' => $updated_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteCategoryInformation($id){
        return Category::where('id', $id)->update([
            'category_status' => 0
        ]);
    }

    

    /*
    =================================================================
    ========================== Product =============================
    =================================================================
    */

    public function getProductInformation($id){
        if($id == null){
            return Product::where('product_status', 1)->get();
        }else{
            return Product::where('product_status', 1)->where('id', $id)->first();
        }
    }

    public function insertProductInformation($name, $supplier_id, $unit_id, $category_id, $quantity, $product_slug, $created_by){
        return Product::insertGetId([
            'name' => $name,
            'supplier_id' => $supplier_id,
            'unit_id' => $unit_id,
            'category_id' => $category_id,
            'quantity' => 0,
            'product_slug' => $product_slug,
            'created_by' => $created_by,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateProductInformation($id, $name, $supplier_id, $unit_id, $category_id, $quantity, $product_slug, $updated_by){
        return Product::where('id', $id)->update([
            'name' => $name,
            'supplier_id' => $supplier_id,
            'unit_id' => $unit_id,
            'category_id' => $category_id,
            'quantity' => 0,
            'product_slug' => $product_slug,
            'updated_by' => $updated_by,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteProductInformation($id){
        return Product::where('id', $id)->update([
            'product_status' => 0
        ]);
    }



    /*
    =================================================================
    ========================== Purchase =============================
    =================================================================
    */


    public function getPurchaseInformation($id){
        if($id == null){
            return Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        }
        else{
            return Purchase::where('id', $id)->first();
        }
    }

    public function insertPurchaseInformation($date, $purchase_no, $supplier_id, $category_id, $product_id, $buying_qty, $unit_price, $buying_price, $description, $purchase_slug, $created_by){
        return Purchase::insertGetId([
            'date' => $date,
            'purchase_no' => $purchase_no,
            'supplier_id' => $supplier_id,
            'category_id' => $category_id,
            'product_id' => $product_id,
            'buying_qty' => $buying_qty,
            'unit_price' => $unit_price,
            'buying_price' => $buying_price,
            'description' => $description,
            'purchase_slug' => $purchase_slug,
            'created_by' => $created_by,
            'created_at' => Carbon::now()
        ]);
    }

    public function deletePurchaseInformation($id){
        return Purchase::where('id', $id)->delete();
    }
    
    public function getPurchaseInPendingInformation($id){
        if($id == null){
            return Purchase::where('purchase_status',0)->orderBy('date','desc')->orderBy('id','desc')->get();
        }
        else{
            return Purchase::where('id', $id)->first();
        }
    }

    public function approvePurchaseInformation($id){
        return Purchase::where('id', $id)->update([
            'purchase_status' => 1
        ]);
    }


    /*
    =================================================================
    ========================== Invoice ==============================
    =================================================================
    */



}
