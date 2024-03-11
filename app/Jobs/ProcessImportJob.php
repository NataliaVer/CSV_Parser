<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 1200;
    private $storedFile;
    /**
     * Create a new job instance.
     */
    public function __construct($storedFile)
    {
        $this->storedFile = $storedFile;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = file($this->storedFile);
        $skipHeader = true;
        $chunks = array_chunk($file, 2000);
        $header = ['name', 'last_name', 'age', 'street', 'house', 'city', 'state', 'zip', 'currency', 'housecolor', 'date'];

        foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
            if($key == 0){
                unset($data[0]);
            }

            //remove column id
            $data = array_map(function($arr) {
                unset($arr[0]);
                return $arr;
            }, $data);

            //unique elements
            $data = array_unique($data, SORT_REGULAR);

            dispatch(new ResidentCSVData($data, $header));
        }

        unlink($this->storedFile);

        // $fileStream = fopen($this->storedFile, 'r');
        // $skipHeader = true;
        // $header = ['name', 'last_name', 'age', 'street', 'house', 'city', 'state', 'zip', 'currency', 'housecolor', 'date'];
        // while ($row = fgetcsv($fileStream)) {
        //     if ($skipHeader) {
        //         $skipHeader = false;
        //         continue;
        //     }
        //     $id = array_shift($row);
        //     dispatch(new ResidentCSVData($row, $header));
        // }
        // fclose($fileStream);
        // unlink($this->storedFile);
    }
}
