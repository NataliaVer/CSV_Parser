<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ResidentCSVData;
use App\Models\Resident;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ProcessImportJob;

class FileController extends Controller
{
    Public function home() {
        return view('welcome');
    }

    public function upload(Request $request) {

        if($request->hasFile('csv_file')) {

            // $csvFile = public_path('csv/' . $request->hasFile('csv_file'));
            $file = $request->file('csv_file');
            $storedFile = $file->store('csv', 'public');
            dispatch(new ProcessImportJob(storage_path('app/public/' . $storedFile)));
            return redirect()->route('home')
                                ->with('success', 'CSV is being processed...');
        }
        return true;
    }

    public function export() {
        ob_start();
        header("Content-type: text/csv; charset=utf-8");
        header('Content-Disposition: attachment; filename="example.csv"');
        ob_end_clean();
        $handle = fopen('php://output','w');

        fputcsv($handle, [ "id", "name", "lastname", "age", "street", "house",
            "city", "state", "zip", "currency", "housecolor", "date"
        ]);

        Resident::select("id", "name", "last_name", "age", "street", "house",
                         "city", "state", "zip", "currency", "housecolor", "date")
                  ->chunk(1000, function($residents) use ($handle) {
            foreach($residents->toArray() as $resident) {
                fputcsv($handle, $resident);
            }
        });

        fclose($handle);
        exit;

        return response()->download($handle);

    }
}
