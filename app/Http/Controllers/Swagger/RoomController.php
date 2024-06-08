<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *      path="/api/v1/rooms",
 *      summary="Создание комнаты",
 *      tags={"Rooms"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="hotelId", type="integer", example=1),
 *                      @OA\Property(property="typeId", type="integer", example=1),
 *                      @OA\Property(property="description", type="string", example="description for room"),
 *                      @OA\Property(property="pricePerNight", type="integer", example=1000),
 *                      @OA\Property(property="isAvailable", type="boolean", example="true"),
 *                  )
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Created",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="type", type="string", example="Single"),
 *              @OA\Property(property="description", type="string", example="description for room"),
 *              @OA\Property(property="pricePerNight", type="integer", example=1000),
 *              @OA\Property(property="isAvailable", type="boolean", example="true"),
 *          )
 *      )
 * ),
 * @OA\Get(
 *      path="/api/v1/rooms/{roomId}",
 *      summary="Получение одной комнаты",
 *      tags={"Rooms"},
 *      @OA\Parameter(
 *          description="ID комнаты",
 *          in="path",
 *          name="roomId",
 *          required=true,
 *          @OA\Schema(
 *              type="integer"
 *          ),
 *          example=1,
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="type", type="string", example="Single"),
 *              @OA\Property(property="description", type="string", example="description for room"),
 *              @OA\Property(property="pricePerNight", type="integer", example=1000),
 *              @OA\Property(property="isAvailable", type="boolean", example="true"),
 *          )
 *      )
 * ),
 * @OA\Patch(
 *      path="/api/v1/rooms/{roomId}",
 *      summary="Обновление комнаты",
 *      tags={"Rooms"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID комнаты",
 *          in="path",
 *          name="roomId",
 *          required=true,
 *          @OA\Schema(
 *              type="integer"
 *          ),
 *          example=1,
 *      ),
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="typeId", type="integer", example=1),
 *                      @OA\Property(property="description", type="string", example="description for room"),
 *                      @OA\Property(property="pricePerNight", type="integer", example=1000),
 *                      @OA\Property(property="isAvailable", type="boolean", example=true),
 *                  )
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="id", type="integer", example=1),
 *              @OA\Property(property="typeId", type="integer", example=1),
 *              @OA\Property(property="description", type="string", example="description for room"),
 *              @OA\Property(property="pricePerNight", type="integer", example=1000),
 *              @OA\Property(property="isAvailable", type="boolean", example=true)
 *          )
 *      )
 * ),
 * @OA\Delete(
 *       path="/api/v1/rooms/{roomId}",
 *       summary="Удаление одной комнаты",
 *       tags={"Rooms"},
 *       security={{ "bearerAuth": {} }},
 *       @OA\Parameter(
 *           description="ID комнаты",
 *           in="path",
 *           name="roomId",
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
 * @OA\Post(
 *        path="/api/v1/rooms/{roomId}/images",
 *        summary="Создание изображения для комнаты",
 *        tags={"Rooms"},
 *        security={{ "bearerAuth": {} }},
 *        @OA\Parameter(
 *            description="ID комнаты",
 *            in="path",
 *            name="roomId",
 *            required=true,
 *            @OA\Schema(
 *                type="integer"
 *            ),
 *            example=1
 *        ),
 *        @OA\RequestBody(
 *            required=true,
 *            @OA\MediaType(
 *                mediaType="multipart/form-data",
 *                @OA\Schema(
 *                    @OA\Property(
 *                        property="image",
 *                        type="string",
 *                        format="binary",
 *                        description="Изображение для загрузки"
 *                    )
 *                )
 *            )
 *        ),
 *
 *        @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(type="array",
 *                @OA\Items(
 *                    @OA\Property(property="id", type="integer", example=1),
 *                    @OA\Property(property="url", type="string", example="http://localhost/storage/hotel/1/room/1/1.jpg"),
 *                )
 *            ),
 *        ),
 *   ),
 * @OA\Delete(
 *        path="/api/v1/rooms/{roomId}/images/{imageId}",
 *        summary="Удаления изображения для комнаты",
 *        tags={"Rooms"},
 *        security={{ "bearerAuth": {} }},
 *        @OA\Parameter(
 *            description="ID комнаты",
 *            in="path",
 *            name="roomId",
 *            required=true,
 *            @OA\Schema(
 *                type="integer"
 *            ),
 *            example=1
 *        ),
 *        @OA\Parameter(
 *            description="ID изображения",
 *            in="path",
 *            name="imageId",
 *            required=true,
 *            @OA\Schema(
 *                type="integer"
 *            ),
 *            example=1
 *        ),
 *
 *        @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(type="object", example={}),
 *        ),
 *   ),
 */

class RoomController extends Controller
{
    //
}
