<?php

namespace App\Swagger\V1\Base;

/**
 *
 * @OA\Put(
 * path="/base/users/{id}",
 * tags={"Base - users"},
 * @OA\Parameter(ref="#/components/parameters/OA_id"),
 * @OA\RequestBody( @OA\MediaType( mediaType="application/x-www-form-urlencoded", @OA\Schema(
                
 *      @OA\Property(
 *          property="name",
 *      ),
 *      @OA\Property(
 *          property="email",
 *      ),
 *      @OA\Property(
 *          property="email_verified_at",
 *      ),
 *      @OA\Property(
 *          property="password",
 *      ),
 *      @OA\Property(
 *          property="username",
 *      ),
 *      @OA\Property(
 *          property="is_active",
 *      ),
 *      @OA\Property(
 *          property="remember_token",
 *      )
 * ))),
 * @OA\Parameter(ref="#/components/parameters/OA_Relations"),
 * security={{"bearerAuth":{}}},
 * @OA\Response(response=200, description="return User Model", @OA\JsonContent()),
 * )
 */

class DocUserControllerUpdateSwagger {}
