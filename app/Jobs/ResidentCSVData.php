<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
Use App\Models\Resident;

class ResidentCSVData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $header;
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $residentInput = array_combine($this->header, $this->data);
        // Resident::updateOrCreate($residentInput);
        
        //remove column id
        $data = array_map(function($arr) {
            unset($arr[0]);
            return $arr;
        }, $this->data);

        //unique elements
        $data = array_unique($data, SORT_REGULAR);
        foreach($data as $resident) {
            $residentInput = array_combine($this->header, $resident);
            Resident::updateOrCreate($residentInput);
        }
    }
}
