<?php

namespace My;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class User{
    const COOKIE_NAME = "session_token";

    public static function getToken(): string 
    {
        $token = $_COOKIE[COOKIE_NAME];
        return $token;
    }
    public static function getId(): int 
    {
        $id = $_SESSION["uid"];
        return $id;
    }
    public static function isAuth(): bool
    {
        return isset($_COOKIE[COOKIE_NAME]);
    }
}