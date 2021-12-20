<?php 
require_once __DIR__ . "/../../../vendor/autoload.php"; 


use My\Database;
use My\Helpers;
use My\user;

$db = new Database();

if ( User::isAuth() ){
    $session_token = User::getToken();
    Helpers::log()->debug($session_token);
    $sql = "SELECT token from user_tokens WHERE token = '$session_token' and type = 'S';";
    $sentencia = $db->prepare($sql);
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    Helpers::log()->debug($_COOKIE["session_token"]);

    if ( $contador < 1 ){
        setcookie(User::COOKIE_NAME,"",time()-3600);
        unset($_SESSION["uid"]);
        Helpers::flash("La sessió ha expirat");
    }
    else{
        Helpers::flash("No hi ha sessió per a expirar");
    }
    Helpers::redirect($url);
    $url = Helpers::url("/html/home.php");
}

Helpers::flash("No existeix una sessió");
$url = Helpers::url("/_commons/html/home.php");
Helpers::redirect($url);