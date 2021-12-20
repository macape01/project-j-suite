<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use My\Mail;
use My\User;
use Rakit\Validation\Validator;

if (User::isAuth()){
    echo "hola";
    $session_token=User::getToken();
    $db = new Database();
    $sql = "SELECT token FROM user_tokens WHERE token = '$session_token' and type = 'S';";
    echo $sql;
    $sentencia=$db->prepare($sql);
    echo "adios";
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    echo $contador;
    if ( $contador >= 1 ){
        $sql = "DELETE FROM user_tokens WHERE token = '$session_token';";
        Helpers::log()->debug($sql);
        $sentencia=$db->prepare($sql);
        $sentencia->execute();
        Helpers::log()->debug($sentencia);

        
    }else{
        $url = Helpers::url("/_commons/home.php");
        Helpers::redirect($url);
        
}
}else{
        $url = Helpers::url("/_commons/home.php");
        Helpers::redirect($url);
}