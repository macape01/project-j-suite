<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;
use My\Helpers;

$validator = new Validator();
$existe = false;

$validation = $validator->make($_POST + $_FILES, [
    'username'           => 'required|min:6',
//    'name'               => 'required',
//    'lastname'           => 'required',
    'email'              => 'required|email',
//    'password'           => 'required|min:8|regex:/\d/',
//    'passwordrepeat'     => 'required|same:password',
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


    try {
        $db = new Database();
        $sql = "SELECT email FROM `2daw.equip01`.users WHERE email = '{$email}'";
        $sentencia = $db->prepare($sql);
        $sentencia->execute();
    
        foreach ($sentencia->fetchAll() as $comprobar){
            if($comprobar['email']==$_POST['email']){
                $existe = true;
                break;
            }
        }

        $sql = "SELECT username FROM `2daw.equip01`.users WHERE username = '{$username}'";
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
            $sql = "INSERT INTO `2daw.equip01`users (email, username, status) VALUES ('$email', '$username', 0)";
            $sentencia3 = $db->prepare($sql);
            $sentencia3->execute();
            My\Helpers::log()->debug("CREADISIMO BRO");

            
        }    
    } catch (Exception $e) {
        My\Helpers::log()->err("ERRORRRRRRRRRRRRR");
    }
}
?>