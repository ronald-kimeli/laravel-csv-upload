<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LocationCollection extends ResourceCollection
{
    public static $wrap = false;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Postcode' => $this->Postcode,
            'Street_Address' => $this->Street_Address,
            'Lat' => $this->Lat,
            'Long' => $this->Long,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
