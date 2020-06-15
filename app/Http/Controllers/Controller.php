<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function jsonResponse($data, $code = 200)
    {
        return response()->json(
            $data,
            $code,
            ['Access-Control-Allow-Origin' => 'http://localhost:8080', 'Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'UTF-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
