
<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use Rakit\Validation\Validator;

$token = $_GET["token"];


$db = new Database();
$sentencia = $db->prepare("SELECT * FROM user_tokens WHERE token= '{$token}';");
Helpers::log()->debug($token);
$sentencia->execute();
$result = $sentencia->fetchAll();
$contador = count($result);
if ( $contador >= 1 ){
    $url = Helpers::url("/user/html/user.forgot03.php");
    Helpers::log()->debug($url);
    Helpers::redirect($url); 
}else{
    Helpers::flash("Incorrecto");
    $url = Helpers::url("/user/html/user.forgot01.php");
    Helpers::log()->debug($url);
    Helpers::redirect($url);
}