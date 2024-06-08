<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/auth/login",
 *     summary="Авторизация пользователя",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="email", type="string", example="email@example.com"),
 *                      @OA\Property(property="password", type="string", example="password"),
 *                  )
 *              }
 *          )
 *     ),
 *     @OA\Response(
 *          response=201,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="token", type="string", example="1|QOshmvynOwLP8o6dobkhthcaKb8a5YGAeOM37o8v9f39eb0b"),
 *              @OA\Property(property="tokenType", type="string", example="bearer"),
 *          )
 *     )
 * ),
 * @OA\Post(
 *      path="/api/v1/auth/register",
 *      summary="Регистрация пользователя",
 *      tags={"Auth"},
 *      @OA\RequestBody(
 *           @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema(
 *                       @OA\Property(property="email", type="string", example="email@example.com"),
 *                       @OA\Property(property="password", type="string", example="password"),
 *                       @OA\Property(property="passwordConfirmation", type="string", example="password"),
 *                   )
 *               }
 *           )
 *      ),
 *      @OA\Response(
 *           response=201,
 *           description="Ok",
 *           @OA\JsonContent(
 *               @OA\Property(property="token", type="string", example="1|QOshmvynOwLP8o6dobkhthcaKb8a5YGAeOM37o8v9f39eb0b"),
 *               @OA\Property(property="tokenType", type="string", example="bearer"),
 *           )
 *      )
 *  ),
 * @OA\Post(
 *      path="/api/v1/auth/resend_email_verification_link",
 *      summary="Отправить новую ссылку на подтверждение электронной почты",
 *      tags={"Auth"},
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                   @OA\Schema(
 *                       @OA\Property(property="email", type="string", example="email@example.com"),
 *                   )
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(type="object", example={})
 *      )
 * )
 */

class AuthController extends Controller
{
    //
}
