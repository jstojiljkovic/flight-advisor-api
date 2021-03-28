<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRouteRequest;
use App\Interfaces\Services\RouteServiceInterface;
use Illuminate\Http\Response;

class RouteController extends Controller
{
    /**
     * Imports routes inside a database
     *
     * @OA\Post(
     *     path="/flight-advisor/v1/routes/import",
     *     tags={"Routes"},
     *     operationId="import",
     *     summary="Import routes into storage",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Routes to import",
     *                     property="routes",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"routes"}
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
     * @param ImportRouteRequest $request
     * @param RouteServiceInterface $routeService
     *
     * @return Response
     */
    public function import(ImportRouteRequest $request, RouteServiceInterface $routeService)
    {
        $routeService->import($request->file('routes'));
        
        return response()->noContent();
    }
}
