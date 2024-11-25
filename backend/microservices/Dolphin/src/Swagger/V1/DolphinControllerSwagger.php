<?php

namespace DolphinMicroservice\Swagger\V1;

/**
 *
 * @OA\Post(
 * path="/auth/login",
 * tags={"Auth"},
 * @OA\RequestBody( @OA\MediaType( mediaType="application/x-www-form-urlencoded", @OA\Schema(
 *      @OA\Property(
 *          property="email",
 *      ),
 *      @OA\Property(
 *          property="password",
 *      ),
 *      @OA\Property(
 *          property="platform_id",
 *      )
 * ))),
 * @OA\Response(response=200, description="return token", @OA\JsonContent()),
 * )
 *
 * @OA\Get(
 * path="/auth/me",
 * tags={"Auth"},
 * @OA\Parameter(ref="#/components/parameters/OA_Relations"),
 * security={{"bearerAuth":{}}},
 * @OA\Response(response=200, description="return user Model", @OA\JsonContent()),
 * )
 *
 * @OA\Post(
 * path="/auth/logout",
 * tags={"Auth"},
 * @OA\RequestBody( @OA\MediaType( mediaType="application/x-www-form-urlencoded", @OA\Schema(
 *      @OA\Property(
 *          property="refresh_token",
 *      )
 * ))),
 * security={{"bearerAuth":{}}},
 * @OA\Response(response=200, description="return success true", @OA\JsonContent()),
 * )
 *
 * @OA\Post(
 * path="/auth/tokens/refresh-token",
 * tags={"Auth"},
 * @OA\RequestBody( @OA\MediaType( mediaType="application/x-www-form-urlencoded", @OA\Schema(
 *      @OA\Property(
 *          property="refresh_token",
 *      )
 * ))),
 * security={{"bearerAuth":{}}},
 * @OA\Response(response=200, description="return success true", @OA\JsonContent()),
 * )
 *
 * @OA\Post(
 * path="/auth/change-password",
 * tags={"Auth"},
 * @OA\RequestBody( @OA\MediaType( mediaType="application/x-www-form-urlencoded", @OA\Schema(
 *      @OA\Property(
 *          property="password_old",
 *      ),
 *      @OA\Property(
 *          property="password",
 *      ),
 *      @OA\Property(
 *          property="password_confirmation",
 *      )
 * ))),
 * security={{"bearerAuth":{}}},
 * @OA\Response(response=200, description="return success true", @OA\JsonContent()),
 * )
 */

class DolphinControllerSwagger {}
