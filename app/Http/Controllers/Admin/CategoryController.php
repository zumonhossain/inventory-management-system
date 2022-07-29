<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller{
    public function allCategory(){
        $categorys = (new ManageInfoService())->getCategoryInformation(null);
        return view('admin.category.all_category',compact('categorys'));
    }

    public function addCategoryForm(){
        return view('admin.category.add_category');
    }

    public function editCategoryForm($id){
        $category = (new ManageInfoService())->getCategoryInformation($id);
        return view('admin.category.edit_category',compact('category'));
    }

    public function insertCategoryFormSubmit(Request $request){

        $category_slug = uniqid('category-15');
        $created_by = Auth::user()->id;

        (new ManageInfoService())->insertCategoryInformation(
            $request['name'],
            $category_slug,
            $created_by,
        );

        $notification = array(
            'message' => 'Category Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_category')->with($notification);
    }

    public function updateCategoryFormSubmit(Request $request){

        $category_slug = uniqid('category-15');
        $updated_by = Auth::user()->id;

        (new ManageInfoService())->updateCategoryInformation(
            $request['id'],
            $request['name'],
            $category_slug,
            $updated_by,
        );

        $notification = array(
            'message' => 'Category Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_category')->with($notification);
    }

    public function deletecategory($id){
        (new ManageInfoService())->deleteCategoryInformation($id);

        $notification = array(
            'message' => 'Category Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all_category')->with($notification);
    }
}
