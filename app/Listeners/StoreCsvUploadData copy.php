<?php

namespace App\Listeners;

use League\Csv\Reader;
use App\Events\CsvUploadData;
use App\Models\CsvUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\HttpFoundation\Response;

class StoreCsvUploadData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CsvUploadData $event): void
    {

          //Loading too many lines of csv
          DB::disableQueryLog();
          DB::connection()->unsetEventDispatcher();

        $reader = Reader::createFromPath("{$event->name}", 'r');
        $reader->setHeaderOffset(0);

        $locations = [];
        foreach($reader as $record){
            dd($record);
        }
        foreach ($reader->chunk(1024) as $chunk) {
                    $service_array = explode("\n", $chunk);
                    foreach($service_array as $ray){
                            $record = explode(",", $ray);
                            // dd($record);
                            if(@$record[0] != '' && @$record[1] != '' && @$record[2] != '' && @$record[3] != ''){
                                $locations[] = [
                                    'Street_Address' => preg_replace('/[^a-zA-Z0-9 ]/m', '',  @$record[0]),
                                    'Postcode' => @$record[1],
                                    'Lat' => @$record[2],
                                    'Long' => @$record[3],
                                    'Timestamp' => now()
                                ];
                            }
                        }
        }

        // dd($locations);
        foreach (array_chunk($locations, 1000) as $locationChunk) {
            // dd($locationChunk);
             DB::table('csv_uploads')->insert($locationChunk);
            //  CsvUpload::insert($locationChunk);
        }
    }
}
