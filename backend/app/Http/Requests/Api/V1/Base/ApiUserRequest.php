<?php

namespace App\Http\Requests\Api\V1\Base;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiUserRequest extends FormRequest
{

  public function authorize()
  {

    return true;
  }

  public function rules()
  {
    return [
      "name" => [
        "nullable",
      ],
      "email" => [
        "nullable",
      ],
      "email_verified_at" => [
        "nullable",
      ],
      "password" => [
        "nullable",
      ],
      "username" => [
        "nullable",
      ],
      "is_active" => [
        "nullable",
      ],
      "remember_token" => [
        "nullable",
      ],
    ];
  }
}
