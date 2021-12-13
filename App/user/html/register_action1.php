<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;
use My\Helpers;
use My\Mail;

$validator = new Validator();
$existe = false;

$validation = $validator->make($_POST + $_FILES, [
    'username'           => 'required|min:6',
    'name'               => 'required',
    'lastname'           => 'required',
    'email'              => 'required|email',
    'password'           => 'required|min:8|regex:/\d/',
    'passwordrepeat'     => 'required|same:password',
//    'avatar'             => 'required|uploaded_file:1MB,jpg,png,gif',
]);

$validation->validate();

if ($validation->fails()) {
    $url = Helpers::url("/user/html/register2.php");
    Helpers::redirect($url);
} 
else {
    My\Helpers::log()->debug("Success!");

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    try {
        $db = new Database();
        $sql = "SELECT email FROM users WHERE email = '{$email}'";
        $sentencia = $db->prepare($sql);
        $sentencia->execute();
    
        foreach ($sentencia->fetchAll() as $comprobar){
            if($comprobar['email']==$_POST['email']){
                $existe = true;
                break;
            }
        }

        $sql = "SELECT username FROM users WHERE username = '{$username}'";
        $sentencia2 = $db->prepare($sql);
        $sentencia2->execute();

        foreach ($sentencia2->fetchAll() as $comprobar){
            if($comprobar['username']==$_POST['username']){
                $existe = true;
                break;
            }
        }
    
        if ($existe == true){
            My\Helpers::log()->debug("MISSATGE D'ERROR: L'usuari o email ja existeix!");
            $url = Helpers::url("/user/html/register2.php");
            Helpers::redirect($url);
        }
    
        if ($existe == false){
            $date = date('Y-m-d H:i:s');
            $encripta = hash('sha256', $password);
            $sql = "INSERT INTO users (email, username, status, password, role_id, created, last_access ) VALUES ('$email', '$username', 0, '$encripta', 2, '{$date}', '{$date}')";
            $sentencia3 = $db->prepare($sql);
            $sentencia3->execute();
            My\Helpers::log()->debug("HASH + CREACIÓ DE USUARIOS GUAY");
            $sql = "SELECT id FROM users WHERE username = '{$username}'";
            $sentencia4 = $db->prepare($sql);
            $sentencia4->execute();
            $resulttoken = $sentencia4->fetchAll(PDO::FETCH_OBJ);
            $user=$resulttoken[0];
            $idtoken=$user->id;
            $bytes = random_bytes(20);
            $token = bin2hex($bytes);
            $sql = "INSERT INTO user_tokens (token, type, user_id, created) VALUES ('$token', 'A', $idtoken, '{$date}')"; //Preguntar como sacar la id, despues de hacer un isert de un nuevo usuario
            $sentencia5 = $db->prepare($sql);
            $sentencia5->execute();
            if ($sentencia5 == true){
                My\Helpers::log()->debug("TOKEN SUBIDO A YUTUB PERFESTO");
                $url_seguent = Helpers::url("/user/html/register_action2.php?token={$token}");
                $subject = "Completa tu registro! ";
                $body = "{$url_seguent}";
                $isHtml = true;
                $to = ["2daw.equip01@fp.insjoaquimmir.cat"];
                $SendMail = new Mail($subject, $body, $isHtml);
                My\Helpers::log()->debug("MAIL A PUNTO DE ENVIAR");
                $ok = $SendMail->send($to);
                if ($ok){
                    My\Helpers::log()->debug("MAIL ENVIADO");
                    $url = Helpers::url("/user/html/register2.php");
                    Helpers::redirect($url);
                    My\Helpers::log()->debug("REVISA TU MAIL");
                } else {
                    My\Helpers::log()->debug("NO SE ENVIA EL MAIL");
                }
            }
            if ($sentencia5 == false){
                My\Helpers::log()->debug("NO SE HA ENVIADO EL TOKEN");
            }
        }   
    } catch (Exception $e) {
        My\Helpers::log()->error($e);
    }
}
?>