<?php

namespace Libs\Helpers;

class HTTP {
    static $baseURL = "http://localhost/mpify/";

    static function redirect($uri) {
        $url = static::$baseURL . $uri;
        header("location:$url");
        exit();
    }
}