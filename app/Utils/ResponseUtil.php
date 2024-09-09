<?php

namespace App\Utils;

class ResponseUtil {
    public static function createMsg($res, $statusCode, $message = "", $data, $error){
        $response = [
            'status' => $statusCode,
            'message' => $message
        ];

        if($data != null){
            $response['data'] = $data;
        }

        if($error != null){
            $response['error'] = $error;
        }

        return response()->json($response); 
    }

    public static function SearchOk($res, $page, $perPage, $totalRows, $totalPages, $data){
        $msg = "";
        return self::createMsg($res, 200, $msg, $data, null);
    }

    public static function Ok($res, $msg, $data){
        return self::createMsg($res, 200, $msg, $data, null);
    }

    public static function BadRequest($res, $msg){
        return self::createMsg($res, 400, $msg, null, "Bad Request");
    }

    public static function Unauthorized($res, $msg){
        return self::createMsg($res, 401, $msg, null, "Unauthorized");
    }

    public static function Forbidden($res, $msg){
        return self::createMsg($res, 403, $msg, null, "Forbidden");
    }

    public static function InternalServerError($res, $msg){
        return self::createMsg($res, 500, $msg, null, "Internal Server Error");
    }

}