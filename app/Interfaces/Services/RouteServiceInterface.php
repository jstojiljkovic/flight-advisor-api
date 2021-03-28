<?php

namespace App\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface RouteServiceInterface
{
    /**
     * Import airports
     *
     * @param UploadedFile $file
     */
    public function import(UploadedFile $file): void;
}
