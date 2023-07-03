<?php

namespace App\Http\Controllers;

use App\Events\CsvUploadData;
use App\Models\CsvUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCsvUploadRequest;


class CsvUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fileupload');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'filenames' => 'required'
        ])->validate();

        $files = $request->file('filenames');

        $path = public_path() . '/uploads';

        $count_csvfiles = 0;
        foreach ($files as $file) {
            if($file->getClientOriginalExtension() == 'csv'){
                $count_csvfiles++;
                // rename & upload files to uploads folder
                $nameFile = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                $file->move($path, $nameFile);
                $name = $path . '/' . $nameFile;
                event(new CsvUploadData($name));
            }
        }

        return back()->with("success", $count_csvfiles . " Csv files uploaded successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(CsvUpload $csvUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CsvUpload $csvUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCsvUploadRequest $request, CsvUpload $csvUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CsvUpload $csvUpload)
    {
        //
    }
}
