<?php

namespace App\Utils;

class StringUtil {

    public static function ErrorMessage($validator){
        $errors = $validator->errors();
        $errors = $errors->toArray();
        $formattedErrors = [];
        foreach ($errors as $messages) {
            array_push($formattedErrors, $messages[0]);
        }
        return $formattedErrors;
    }
}