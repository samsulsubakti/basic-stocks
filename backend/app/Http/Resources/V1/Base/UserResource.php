<?php

namespace App\Http\Resources\V1\Base;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{

  public function toArray(Request $request): array
  {

    return [
      "id" => $this->id,
      "uuid" => $this->uuid,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at,
      "deleted_at" => $this->deleted_at,
      "created_by" => $this->created_by,
      "updated_by" => $this->updated_by,
      "deleted_by" => $this->deleted_by,
      "name" => $this->name,
      "email" => $this->email,
      "email_verified_at" => $this->email_verified_at,
      "username" => $this->username,
      "is_active" => $this->is_active,

      "createdBy" => new UserResource($this->whenLoaded("createdBy")),
      "updatedBy" => new UserResource($this->whenLoaded("updatedBy")),
      "deletedBy" => new UserResource($this->whenLoaded("deletedBy")),
    ];
  }
}
