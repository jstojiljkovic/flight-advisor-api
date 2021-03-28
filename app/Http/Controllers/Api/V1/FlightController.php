<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FindCheapestFlight;
use App\Interfaces\Services\FlightServiceInterface;
use Illuminate\Http\JsonResponse;

class FlightController extends Controller
{
    /**
     * Finds cheapest flight between two cities
     *
     * @OA\Get(
     *     path="/flight-advisor/v1/flights/cheapest",
     *     tags={"Flights"},
     *     operationId="cheapest",
     *     summary="Returns the cheapest  route from city A to B",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\Parameter(
     *     description="City you are flying from",
     *     in="query",
     *     name="city1",
     *     required=true,
     *     @OA\Schema(
     *           type="string",
     *         )
     *     ),
     * @OA\Parameter(
     *     description="City you are flying to",
     *     in="query",
     *     name="city2",
     *     required=true,
     *      @OA\Schema(
     *           type="string"
     *         )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="data", type="array",
     *     @OA\Items(
     *
     *       @OA\Property(property="start", type="object",
     *       @OA\Property(
     *                   property="airline",
     *                   example="Hartsfield Jackson Atlanta International Airport",
     *                   type="string"
     *               ),
     *      @OA\Property(
     *                   property="city",
     *                   example="Atlanta",
     *                   type="string"
     *               ),
     *      @OA\Property(
     *                   property="country",
     *                   example="United States",
     *                   type="string"
     *               ),
     *   ),   @OA\Property(property="end", type="object",
     *      @OA\Property(
     *                   property="name",
     *                   example="Dothan Regional Airport",
     *                   type="string"
     *               ),
     *      @OA\Property(
     *                   property="city",
     *                   description="Dothan",
     *                   type="string"
     *               ),
     *      @OA\Property(
     *                   property="country",
     *                   example="United States",
     *                   type="string"
     *               ),
     *   ),@OA\Property(property="price", type="float", example="42.04"),)),)
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
     * @OA\Response(
     *     response=404,
     *     description="Returns when cities with the provided id does not exists",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Airport in the city Nis does not exist"),
     *     )
     *  ),
     * )
     *
     * @param FindCheapestFlight $request
     * @param FlightServiceInterface $flightService
     *
     * @return JsonResponse
     */
    public function cheapest(FindCheapestFlight $request, FlightServiceInterface $flightService)
    {
        $cheapestRoute = $flightService->findCheapest($request->get('city1'), $request->get('city2'));
        
        return response()->json([ 'data' => $cheapestRoute ], 200);
    }
}
