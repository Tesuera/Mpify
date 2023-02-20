<?php

namespace Libs\Helpers;

class Auth {
    static function check () {
        session_start();
        if(!isset($_SESSION['auth'])) {
            HTTP::redirect("login.php");
        } else {
            return $_SESSION['auth'];
        }
    }

    static function attempt ($data) {
        session_start();
        $_SESSION['auth'] = $data;
        return true;
    }

    static function issetAuth() {
        if(isset($_SESSION['auth'])) {
            HTTP::redirect("");
        } else {
            return  true;
        }
    }
}