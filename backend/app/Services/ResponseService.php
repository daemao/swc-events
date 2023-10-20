<?php
namespace App\Services;
class ResponseService{
    public static function generateResponse($message=null,$error=null){
        return [
            'error'=>$error,
            'result'=>$message
        ];
    }
}
