<?php
namespace App\Api;

class ApiError
{
    public static function  errorMessage($mensagem, $code){
        return[
            'data' => [
                'mensagem' => $mensagem,
                'code' => $code
            ]
        ];
    }
}
