<?php

namespace App\Http\Resources;

class GeneralResponse
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    const CODE_OK = 1 ;

    const CODE_ERROR = -1 ;

    private function __construct()
    {

    }

    public static function toArray(int $code , string $msg , $content = null)
    {
        return [
            'code' => $code ,
            'message' => $msg ,
            'content' =>$content
        ];
    }

    public static function success($content = null , string $msg = ''){

        return self::toArray(self::CODE_OK , $msg , $content);

    }

    public static function failed(string $msg , $content = null){

        return self::toArray(self::CODE_ERROR , $msg , $content);

    }

}
