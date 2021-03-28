<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityCommentRequest;
use App\Interfaces\Services\CommentServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * @var CommentServiceInterface
     */
    protected CommentServiceInterface $commentService;
    
    /**
     * CommentController constructor.
     *
     * @param CommentServiceInterface $commentService
     */
    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @OA\PATCH(
     *     path="/flight-advisor/v1/comments/{commentId}",
     *     tags={"City"},
     *     operationId="commentUpdate",
     *     summary="Updates an existing comment",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\Parameter(
     *     description="Comment id to update",
     *     in="path",
     *     name="commentId",
     *     required=true,
     *     @OA\Schema(
     *           type="integer",
     *         )
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Update comment",
     *    @OA\JsonContent(
     *       required={"comment"},
     *       @OA\Property(property="comment", type="string", example="Serbia is a drinking problem country"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="data", type="array",
     *     @OA\Items(
     *        @OA\Property(property="id", type="int", example="1"),
     *        @OA\Property(property="comment", type="string", example="Serbia is a drinking problem country"),
     *        @OA\Property(property="city_id", type="integer", example="1"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *   )),)
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
     *     description="Returns when comment with the provided id does not exists",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Comment with the provided id does not exist."),
     *     )
     *  ),
     * )
     *
     * @param StoreCityCommentRequest $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function update(StoreCityCommentRequest $request, $id)
    {
        $comment = $this->commentService->update($id, $request->validated());
        
        return response()->json([ 'data' => $comment ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/flight-advisor/v1/comments/{commentId}",
     *     tags={"Comments"},
     *     operationId="commentDelete",
     *     summary="Deletes comment",
     *     description="",
     *     security={ {"basic": {} }},
     * @OA\Parameter(
     *     description="Comment id to delete",
     *     in="path",
     *     name="commentId",
     *     required=true,
     *     @OA\Schema(
     *           type="integer",
     *         )
     *     ),
     * @OA\Response(
     *     response=204,
     *     description="Success",
     *     @OA\JsonContent()
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
     *     description="Returns when comment with the provided id does not exists",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Comment with the provided id does not exist."),
     *     )
     *  ),
     * )
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->commentService->destroy($id);
        
        return response()->noContent();
    }
}
