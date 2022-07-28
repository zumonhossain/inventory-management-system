<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileUploadController extends Controller{
    public function uploadCustomerImage(Request $request) {
        if($request->hasFile('customer_image')) {
            $file = $request->file('customer_image');
            $destinationPath = "upload/customer-image";
            $fileName = rand(100000,999999).'.jpg';
            $file->move($destinationPath,$fileName);
            return $destinationPath.'/'.$fileName;
        }
        return '';
    }
}
