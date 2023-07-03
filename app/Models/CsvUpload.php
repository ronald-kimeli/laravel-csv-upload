<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'Street_Address',
        'Postcode',
        'Lat',
        'Long',
    ];

    protected $casts = [
        'Timestamp' => 'datetime',
    ];
}
