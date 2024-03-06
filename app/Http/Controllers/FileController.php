<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\LazyCollection;
use App\Jobs\ResidentCSVData;
use Illuminate\Support\Facades\Bus;

class FileController extends Controller
{
    public function upload(Request $request) {

        if($request->hasFile('csv_file')) {
            //display the data
            // "name"
            // "lastname"
            // "age"
            // "street"
            // "house"
            // "city"
            // "state"
            // "zip"
            // "currency"
            // "housecolor"
            // "date"

            $csvFile = public_path('csv/' . $request->hasFile('csv_file'));
            $this->readCSV($request->file('csv_file'));
        }
        return true;
    }

    public function readCSV($file, $delimiter = ',') {
        //read and parse CSV
        $row = 0;
        $file_handle = fopen($file, 'r');
        
        while ($csvRow = fgetcsv($file_handle)) {
            if($row > 0) {
                $line_of_text[] = $csvRow;
            }
            $row++;
        }

        fclose($file_handle);
        dump($line_of_text);
    }
}
