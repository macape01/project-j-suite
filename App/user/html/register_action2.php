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
    $sql = "SELECT token FROM user_tokens WHERE token = '{$_GET['token']}'";
    $sentencia = $db->prepare($sql);
    $sentencia->execute();

    foreach ($sentencia->fetchAll() as $comprobar){
        if($comprobar['token']==$_GET['token']){
            $existe = true;
            break;
        }
    }
    if ($existe){
        My\Helpers::log()->debug("ACTUALITZANT COMPTE AMB STATUS 1 A LA TAULA USERS");
    }
    else{
        My\Helpers::log()->debug("ERROR: NO HEM TROBAT EL TOKEN");
    }
} catch (Exception $e) {
    My\Helpers::log()->err("ERRORRRRRRRRRRRRR");
}
?>