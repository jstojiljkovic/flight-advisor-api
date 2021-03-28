<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportAirportRequest;
use App\Interfaces\Services\AirportServiceInterface;
use Illuminate\Http\Response;

class AirportController extends Controller
{
    /**
     * Imports airports inside a database
     *
     * @OA\Post(
     *     path="/flight-advisor/v1/airports/import",
     *     tags={"Airports"},
     *     operationId="import",
     *     summary="Import airports into storage",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Airports to import",
     *                     property="airports",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"airports"}
     *             )
     *         )
     *     ),
     * @OA\Response(
     *     response=204,
     *     description="Success",
     *     @OA\JsonContent()
     *  ),
     * @OA\Response(
     *     response=422,
     *     description="Returns when validation fails",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="The given data was invalid."),
     *     )
     *  ),
     * @OA\Response(
     *     response=401,
     *     description="Returns when user is not authenticated",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Invalid credentials."),
     *     )
     *  ),
     * )
     *
     * @param ImportAirportRequest $request
     * @param AirportServiceInterface $airportService
     *
     * @return Response
     */
    public function import(ImportAirportRequest $request, AirportServiceInterface $airportService)
    {
        $airportService->import($request->file('airports'));
        
        return response()->noContent();
    }
}
