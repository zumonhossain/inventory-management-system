<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;

class AjaxController extends Controller{

    public function getCategory(Request $request){

        $supplier_id = $request->supplier_id;
        //dd($supplier_id);

        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    }

    public function getProduct(Request $request){

        $category_id = $request->category_id; 
        //dd($supplier_id);
        $allProduct = Product::where('category_id',$category_id)->get();
        return response()->json($allProduct);
    }
}
