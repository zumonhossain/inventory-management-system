<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ManageInfoService;
use Illuminate\Http\Request;
use Auth;

class UnitController extends Controller{
    public function allUnit(){
        $units = (new ManageInfoService())->getUnitInformation(null);
        return view('admin.unit.all_unit',compact('units'));
    }

    public function addUnitForm(){
        return view('admin.unit.add_unit');
    }

    public function editUnitForm($id){
        $unit = (new ManageInfoService())->getUnitInformation($id);
        return view('admin.unit.edit_unit',compact('unit'));
    }

    public function insertUnitFormSubmit(Request $request){

        $unit_slug = uniqid('unit-15');
        $created_by = Auth::user()->id;

        (new ManageInfoService())->insertUnitInformation(
            $request['name'],
            $unit_slug,
            $created_by,
        );

        $notification = array(
            'message' => 'Unit Inserted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_unit')->with($notification);
    }

    public function updateUnitFormSubmit(Request $request){

        $unit_slug = uniqid('unit-15');
        $updated_by = Auth::user()->id;

        (new ManageInfoService())->updateUnitInformation(
            $request['id'],
            $request['name'],
            $unit_slug,
            $updated_by,
        );

        $notification = array(
            'message' => 'Unit Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all_unit')->with($notification);
    }

    public function deleteUnit($id){
        (new ManageInfoService())->deleteUnitInformation($id);

        $notification = array(
            'message' => 'Unit Delete Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all_unit')->with($notification);
    }
}
