<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ResidentCSVData;
use App\Models\Resident;
use Illuminate\Support\Facades\Bus;

class FileController extends Controller
{
    Public function home() {
        return view('welcome');
    }

    public function upload(Request $request) {

        if($request->hasFile('csv_file')) {

            // $csvFile = public_path('csv/' . $request->hasFile('csv_file'));
            $this->readCSV(file($request->file('csv_file')));
            //create file path, becouse you need use copy of file
        //     $file = $request->file('csv_file');
        //     $file = $file->store('csv_file', ['disk' => 'public']);
        //     $fileStream = fopen(storage_path('app/public/' . $file), 'r');

        //     $csvData = [];
        //     while ($row = fgetcsv($fileStream)) {
        //         $csvData[] = $row;
        //     }

        //     fclose($fileStream);

        //     $i = 0;
        //     foreach ($csvData as $dataRow) {
        //         if ($i === 0) {
        //             $i++;
        //             continue;
        //         }
        //     }
        }
        return true;
    }

    public function readCSV($file, $delimiter = ',') {
        //read and parse CSV
        $chunks = array_chunk($file, 2000);
        $header = ['name', 'last_name', 'age', 'street', 'house', 'city', 'state', 'zip', 'currency', 'housecolor', 'date'];
        $batch  = Bus::batch([])->dispatch();

        foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    unset($data[0]);
                }
                // dump($header);
                // dump($data);
                $batch->add(new ResidentCSVData($data, $header));
            }

        return redirect()->route('home')
                            ->with('success', 'CSV Import added on queue. will update you once done.');

        // $name = 1;
        // $lastname = 2;
        // $age = 3;
        // $street = 4;
        // $house = 5;
        // $city = 6;
        // $state = 7;
        // $zip = 8;
        // $currency = 9;
        // $housecolor = 10;
        // $date = 11;
    }

    public function export() {
        $handle = fopen('csv/export.csv','w');

        Resident::chunk(1000, function($residents) use ($handle) {
            fputcsv($handle, [ "id", "name", "last_name", "age", "street", "house",
            "city", "state", "zip", "currency", "housecolor", "date"
        ]);
            foreach($residents->toArray() as $resident) {
                fputcsv($handle, $resident);
            }
        });

        fclose($handle);

        return response()->download('csv/export.csv');

    }
}
