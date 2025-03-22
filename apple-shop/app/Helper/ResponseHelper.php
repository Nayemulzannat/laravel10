<?php

namespace App\Helper;

use illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function Out($msg, $data, $code): JsonResponse
    {
        return  response()->json(['msg' => $msg, 'data' =>  $data], $code);
    }
}
