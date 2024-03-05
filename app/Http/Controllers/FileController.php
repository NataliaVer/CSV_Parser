<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request) {
        
        if($request->hasFile('csv_file')) {
            //read file
        }
        return true;
    }
}
