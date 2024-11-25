<?php

namespace DolphinMicroservice\Http\Controllers\Api\V1;


use DolphinMicroservice\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function store()
    {
        return ['success' => true];
    }
}
