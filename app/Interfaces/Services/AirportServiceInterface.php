<?php

namespace App\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface AirportServiceInterface
{
    /**
     * Import airports
     *
     * @param UploadedFile $file
     */
    public function import(UploadedFile $file): void;
}
