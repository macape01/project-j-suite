<?php 
require_once __DIR__ . "/../../../vendor/autoload.php"; 


use My\Database;
use My\Helpers;

$db = new Database();

if ( !empty($_COOKIE["session_token"]) ){
    $session_token = $_COOKIE["session_token"];
    Helpers::log()->debug($session_token);
    $sql = "SELECT token from user_tokens WHERE token = '$session_token' and type = 'S';";
    $sentencia = $db->prepare($sql);
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    Helpers::log()->debug($_COOKIE["session_token"]);

    if ( $contador < 1 ){
        setcookie("session_token","",time()-3600);
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