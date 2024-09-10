<?php

namespace App\Utils;

class ResponseUtil {
    public static function createMsg($statusCode, $message = "", $data, $error){
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

    public static function SearchOk($page, $perPage, $totalRows, $totalPages, $data){
        $msg = "";
        return self::createMsg(200, $msg, $data, null);
    }

    public static function Ok($msg, $data){
        return self::createMsg(200, $msg, $data, null);
    }

    public static function BadRequest($msg){
        return self::createMsg(400, $msg, null, "Bad Request");
    }

    public static function Unauthorized($msg){
        return self::createMsg(401, $msg, null, "Unauthorized");
    }

    public static function Forbidden($msg){
        return self::createMsg(403, $msg, null, "Forbidden");
    }

    public static function InternalServerError($msg){
        return self::createMsg(500, $msg, null, "Internal Server Error");
    }

}