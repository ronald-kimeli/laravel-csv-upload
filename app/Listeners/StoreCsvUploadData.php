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

        #Ensure csv has headers to iterate through
        $reader->setHeaderOffset(0);

        $locations = [];

        foreach ($reader as $record) {
            $locations[] = [
                'Street_Address' => preg_replace('/[^a-zA-Z0-9 ]/m', '',  $record['Street_Address']),# Since we have some special characters
                'Postcode' => $record['Postcode'],
                'Lat' => $record['Lat'],
                'Long' => $record['Long'],
                'Timestamp' => now()
            ];
        }

        #We will send in chunks to avoid 50k plus record inserted at once
        foreach (array_chunk($locations, 1000) as $locationChunk) {
             CsvUpload::insert($locationChunk);
        }
        
        #Delete the file after processing
        /**
         * We shall insert all processed data to database to track record
         */
        unlink($event->name);
    }
}
