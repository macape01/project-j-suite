<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;
use My\Helpers;

$validator = new Validator();

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
    echo "Success!";

    $email = $_POST['email'];
    $username = $_POST['username'];
    echo $email;
    echo $username;

    $sql = "SELECT email, username FROM users WHERE email = '$email'";
    echo $sql;
    $db = new Database();
    $comprobarNom = $db->prepare($sql);
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    if ($contador == 1) {
        echo "Ja existeix un usuari amb aquest nom d'usuari";
    }
    else {
        echo "Nom d'usuari lliure! ";
    }
    $comprobarMail = $db->prepare("SELECT username FROM users WHERE username = '".$username."'");
}
?>