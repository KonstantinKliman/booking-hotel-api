<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *      path="/api/v1/hotels",
 *      summary="Создание отеля",
 *      tags={"Hotels"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Hotel name"),
 *                      @OA\Property(property="address", type="string", example="Hotel address"),
 *                      @OA\Property(property="starRating", type="integer", example=5),
 *                      @OA\Property(property="description", type="string", example="Hotel description"),
 *                  )
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="userId", type="integer", example=1),
 *              @OA\Property(property="name", type="string", example="Hotel name"),
 *              @OA\Property(property="address", type="string", example="Hotel address"),
 *              @OA\Property(property="starRating", type="integer", example=5),
 *              @OA\Property(property="description", type="string", example="Hotel description"),
 *          ),
 *      ),
 * ),
 * @OA\Get(
 *      path="/api/v1/hotels",
 *      summary="Список отелей",
 *      tags={"Hotels"},
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="hotels", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="userId", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="Hotel name"),
 *                      @OA\Property(property="address", type="string", example="Hotel address"),
 *                      @OA\Property(property="starRating", type="integer", example=5),
 *                      @OA\Property(property="description", type="string", example="Hotel description"),
 *                      @OA\Property(property="imageIds", type="array",
 *                          @OA\Items(type="integer", example={1,2,3}),
 *                      ),
 *                      @OA\Property(property="roomIds", type="array",
 *                          @OA\Items(type="integer", example={1,2,3}),
 *                      ),
 *                  )
 *              ),
 *          ),
 *      ),
 * ),
 * @OA\Get(
 *      path="/api/v1/hotels/{hotelId}",
 *      summary="Получение одного отеля",
 *      tags={"Hotels"},
 *      @OA\Parameter(
 *          description="ID отеля",
 *          in="path",
 *          name="hotelId",
 *          required=true,
 *          example=1
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="hotels", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="userId", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="Hotel name"),
 *                      @OA\Property(property="address", type="string", example="Hotel address"),
 *                      @OA\Property(property="starRating", type="integer", example=5),
 *                      @OA\Property(property="description", type="string", example="Hotel description"),
 *                      @OA\Property(property="imageIds", type="array",
 *                          @OA\Items(type="integer", example={1,2,3}),
 *                      ),
 *                      @OA\Property(property="roomIds", type="array",
 *                          @OA\Items(type="integer", example={1,2,3}),
 *                      ),
 *                  )
 *              ),
 *          ),
 *      ),
 * ),
 * @OA\Patch(
 *      path="/api/v1/hotels/{hotelId}",
 *      summary="Обновление одного отеля",
 *      tags={"Hotels"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID отеля",
 *          in="path",
 *          name="hotelId",
 *          required=true,
 *          example=1
 *      ),
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="New hotel name"),
 *                      @OA\Property(property="address", type="string", example="New hotel address"),
 *                      @OA\Property(property="starRating", type="integer", example=4),
 *                      @OA\Property(property="description", type="string", example="New hotel description"),
 *                  )
 *              }
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="hotels", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="userId", type="integer", example=1),
 *                      @OA\Property(property="name", type="string", example="New hotel name"),
 *                      @OA\Property(property="address", type="string", example="New hotel address"),
 *                      @OA\Property(property="starRating", type="integer", example=4),
 *                      @OA\Property(property="description", type="string", example="New hotel description"),
 *                      @OA\Property(property="imageIds", type="array",
 *                          @OA\Items(type="integer", example={1,2,3}),
 *                      ),
 *                      @OA\Property(property="roomIds", type="array",
 *                          @OA\Items(type="integer", example={1,2,3}),
 *                      ),
 *                  )
 *              ),
 *          ),
 *      ),
 * ),
 * @OA\Delete(
 *       path="/api/v1/hotels/{hotelId}",
 *       summary="Удаление одного отеля",
 *       tags={"Hotels"},
 *       security={{ "bearerAuth": {} }},
 *       @OA\Parameter(
 *           description="ID отеля",
 *           in="path",
 *           name="hotelId",
 *           required=true,
 *           @OA\Schema(
 *               type="integer"
 *           ),
 *           example=1
 *       ),
 *       @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(type="object", example={})
 *       ),
 *  ),
 *  @OA\Post(
 *       path="/api/v1/hotels/{hotelId}/images",
 *       summary="Создание изображения для отеля",
 *       tags={"Hotels"},
 *       security={{ "bearerAuth": {} }},
 *       @OA\Parameter(
 *           description="ID отеля",
 *           in="path",
 *           name="hotelId",
 *           required=true,
 *           @OA\Schema(
 *               type="integer"
 *           ),
 *           example=1
 *       ),
 *       @OA\RequestBody(
 *           required=true,
 *           @OA\MediaType(
 *               mediaType="multipart/form-data",
 *               @OA\Schema(
 *                   @OA\Property(
 *                       property="image",
 *                       type="string",
 *                       format="binary",
 *                       description="Изображение для загрузки"
 *                   )
 *               )
 *           )
 *       ),
 *
 *       @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(type="array",
 *               @OA\Items(
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="url", type="string", example="http://localhost/storage/hotel/1/1.jpg"),
 *               )
 *           ),
 *       ),
 *  ),
 *  @OA\Delete(
 *       path="/api/v1/hotels/{hotelId}/images/{imageId}",
 *       summary="Удаления изображения для отеля",
 *       tags={"Hotels"},
 *       security={{ "bearerAuth": {} }},
 *       @OA\Parameter(
 *           description="ID отеля",
 *           in="path",
 *           name="hotelId",
 *           required=true,
 *           @OA\Schema(
 *               type="integer"
 *           ),
 *           example=1
 *       ),
 *       @OA\Parameter(
 *           description="ID изображения",
 *           in="path",
 *           name="imageId",
 *           required=true,
 *           @OA\Schema(
 *               type="integer"
 *           ),
 *           example=1
 *       ),
 *
 *       @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(type="object", example={}),
 *       ),
 *  ),
 */

class HotelController extends Controller
{

}
