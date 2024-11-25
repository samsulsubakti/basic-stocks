<?php

namespace App\Http\Controllers\Api\V1\Base;

use App\Models\Base\User;
use App\Http\Resources\V1\Base\UserResource;
use App\Http\Requests\Api\V1\Base\ApiUserRequest;
use App\Services\BaseCrud\BaseCrud;

class UserController extends BaseCrud
{

  public $model = User::class;
  public $resource = UserResource::class;
  public $storeValidator = ApiUserRequest::class;
  public $updateValidator = ApiUserRequest::class;
  public $defaultOrder = "id";
  public $modelKey = "id";
  public $cacheInMinute = 10;
}
