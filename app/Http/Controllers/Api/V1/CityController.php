<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchCityRequest;
use App\Http\Requests\StoreCityCommentRequest;
use App\Http\Requests\StoreCityRequest;
use App\Interfaces\Services\CityServiceInterface;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    protected CityServiceInterface $cityService;
    
    /**
     * CityController constructor.
     *
     * @param CityServiceInterface $cityService
     */
    public function __construct(CityServiceInterface $cityService)
    {
        $this->cityService = $cityService;
    }
    
    /**
     * Show all existing cities
     *
     * @OA\Get(
     *     path="/flight-advisor/v1/cities",
     *     tags={"City"},
     *     operationId="index",
     *     summary="Returns all the cities with all the comments or the x leatest comments",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\Parameter(
     *     description="Number of latest comments to be returned",
     *     in="query",
     *     name="comments",
     *     required=false,
     *      @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="data", type="array",
     *     @OA\Items(
     *        @OA\Property(property="id", type="int", example="1"),
     *        @OA\Property(property="name", type="string", example="Nis"),
     *        @OA\Property(property="country", type="string", example="Serbia"),
     *        @OA\Property(property="description", type="string", example="Drinking problem country"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *       @OA\Property(property="comments", type="array",
     *     @OA\Items(
     *           @OA\Property(property="id", type="int", example="1"),
     *           @OA\Property(property="comment", type="text", example="This is just a random comment"),
     *           @OA\Property(property="city_id", type="int", example="1"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *     )),)),)
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
     * @param SearchCityRequest $request
     *
     * @return JsonResponse
     */
    public function index(SearchCityRequest $request)
    {
        $cities = $this->cityService->getAll($request->input('comments', null));
        
        return response()->json([ 'data' => $cities ], 200);
    }
    
    /**
     * Search city by name
     *
     * @OA\Get(
     *     path="/flight-advisor/v1/cities/search",
     *     tags={"City"},
     *     operationId="search",
     *     summary="Returns all the cities with matched name with all the comments or the x leatest comments",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\Parameter(
     *     description="City's name to search",
     *     in="query",
     *     name="name",
     *     required=true,
     *     @OA\Schema(
     *           type="string",
     *         )
     *     ),
     * @OA\Parameter(
     *     description="Number of latest comments to be returned",
     *     in="query",
     *     name="comments",
     *     required=false,
     *      @OA\Schema(
     *           type="integer"
     *         )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="data", type="array",
     *     @OA\Items(
     *        @OA\Property(property="id", type="int", example="1"),
     *        @OA\Property(property="name", type="string", example="Nis"),
     *        @OA\Property(property="country", type="string", example="Serbia"),
     *        @OA\Property(property="description", type="string", example="Drinking problem country"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *       @OA\Property(property="comments", type="array",
     *     @OA\Items(
     *           @OA\Property(property="id", type="int", example="1"),
     *           @OA\Property(property="comment", type="text", example="This is just a random comment"),
     *           @OA\Property(property="city_id", type="int", example="1"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *     )),)),)
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
     * @param SearchCityRequest $request
     *
     * @return JsonResponse
     */
    public function search(SearchCityRequest $request)
    {
        $city = $this->cityService->getByName($request->input('name', ''), $request->input('comments', null));
        
        return response()->json([ 'data' => $city ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/flight-advisor/v1/cities",
     *     tags={"City"},
     *     operationId="store",
     *     summary="Store a newly created city in storage.",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Add city object",
     *    @OA\JsonContent(
     *       required={"name","country","description"},
     *       @OA\Property(property="name", type="string", example="Nis"),
     *       @OA\Property(property="country", type="string", example="Serbia"),
     *       @OA\Property(property="description", type="string", example="Drinking problem country"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="name", type="string", example="Nis"),
     *        @OA\Property(property="country", type="string", example="Serbia"),
     *        @OA\Property(property="description", type="string", example="Drinking problem country"),
     *        @OA\Property(property="id", type="int", example="1"),
     *     )
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
     *  @OA\Response(
     *     response=403,
     *     description="Returns when user does not have correct perimissions",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="You dont have correct permission to access this."),
     *     )
     *  ),
     * )
     *
     * @param StoreCityRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreCityRequest $request)
    {
        $city = $this->cityService->store($request->validated());
        
        return response()->json([ 'data' => $city ], 201);
    }
    
    /**
     * Store a newly created comment resource in storage.
     *
     * @OA\Post(
     *     path="/flight-advisor/v1/cities/{cityId}/comments",
     *     tags={"City"},
     *     operationId="storeComment",
     *     summary="Store a newly created city comment in storage.",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\Parameter(
     *     description="City id to attach comment",
     *     in="path",
     *     name="cityId",
     *     required=true,
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Add comment object",
     *    @OA\JsonContent(
     *       required={"comment"},
     *       @OA\Property(property="comment", type="text", example="This is just a random comment"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="comment", type="string", example="This is just a random comment"),
     *        @OA\Property(property="id", type="int", example="1"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *     )
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
     *     description="Returns when city was not found",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="City with the provided id does not exist."),
     *     )
     *  ),
     * )
     *
     * @param StoreCityCommentRequest $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function storeComment(StoreCityCommentRequest $request, $id)
    {
        $comment = $this->cityService->storeComment($id, $request->validated());
        
        return response()->json([ 'data' => $comment ], 201);
    }
}
