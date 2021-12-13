<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;
use My\Helpers;
use My\Mail;

$existe = false;


try {
    $db = new Database();
    $token=$_GET['token'];
    $sql = "SELECT * FROM user_tokens WHERE token = '$token' AND type = 'A'";
    $sentenciacomparatoken = $db->prepare($sql);
    $sentenciacomparatoken->execute();
    if ($sentenciacomparatoken->rowCount() > 0){
        My\Helpers::log()->debug("ACTUALITZANT COMPTE AMB STATUS 1 A LA TAULA USERS");
        $db = new Database();
        $sql = "UPDATE users SET status = 1 where id = {$sentenciacomparatoken->fetchAll()[0]['user_id']}";
        $sentenciafinal = $db->prepare($sql);
        $sentenciafinal->execute();
        $url = Helpers::url("/user/html/login.php");
        Helpers::redirect($url);
        My\Helpers::log()->debug("Usuario validado correctamente, porfavor, logueate en nuestra pàgina principal");
    }
    else{
        My\Helpers::log()->debug("ERROR: NO HEM TROBAT EL TOKEN");
    }
} catch (Exception $e) {
    My\Helpers::log()->error($e);
}
?>