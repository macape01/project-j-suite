<?php

namespace My;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class User{
    const COOKIE_NAME = "session_token";

    public static function getToken(): string 
    {
        $token = $_COOKIE[self::COOKIE_NAME];
        return $token;
    }
    public static function getId(): int 
    {
        $id = $_SESSION["uid"];
        return $id;
    }
    public static function isAuth(): bool
    {
        $is_empty = empty($_COOKIE[self::COOKIE_NAME]);
        return !$is_empty;
    }
}