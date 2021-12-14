
<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use Rakit\Validation\Validator;

$validator = new Validator();

$validation = $validator->make($_POST, [
    'token'            => 'required',
    'contra1'          => 'required',
    'contra2'          =>  'required',
]);
$validation->validate();


if ($validation->fails()) {
    $url = Helpers::url("/user/html/user.forgot01.php");
    Helpers::log()->debug($url);
    Helpers::redirect($url);
}else{


    $token = $_POST["token"];
    $pass = $_POST["contra1"];
    Helpers::log()->debug($_POST["contra1"]);
    Helpers::log()->debug($_POST["contra2"]);
    Helpers::log()->debug($_POST["token"]);

    $db = new Database();
    $sentencia = $db->prepare("SELECT token FROM user_tokens WHERE token = '{$token}';");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);

    $db = new Database();
    $sentencia = $db->prepare("SELECT user_id FROM user_tokens WHERE token = '{$token}';");
    $sentencia->execute();
    $resultid = $sentencia->fetchAll();
    $contador2 = count($resultid);

    // $sql = "SELECT id FROM users WHERE email='$email'";
    // $stmt = $db->prepare($sql);
    // $stmt->execute();
    // $uid = $stmt->fetchColumn();


    if ( $contador >= 1 ){
        var_dump("hola");
        $db = new Database();
        $sql = "UPDATE users SET password = '{$pass}' where id = {$resultid}";
        $sentencia->execute();
        $result = $sentencia->fetchAll();
        Helpers::log()->debug($result);
        Helpers::log()->debug($sentencia);

        
    }else{
        // Helpers::flash("Incorrecto");
        // $url = Helpers::url("/user/html/user.forgot01.php");
        // Helpers::log()->debug($url);
        // Helpers::redirect($url);
        Helpers::log()->debug($contador);
    }
}