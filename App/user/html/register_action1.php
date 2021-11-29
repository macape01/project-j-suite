<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;
use My\Helpers;

$validator = new Validator();

$validation = $validator->make($_POST + $_FILES, [
//    'username'           => 'required|min:6',
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
    echo $email;

    $db = new Database();
    $sentencia = $db->prepare("SELECT email FROM `2daw.equip01`.users WHERE email = '{$email}'");
    $sentencia->execute();
    foreach ($sentencia as $comprobar){
        if($comprobar['email']==$_POST['email']){
            $existe = true;
            break;
        }
    }

    if ($existe == true){
        echo "HOLA";
    }

    if ($existe == false){
        echo "ADIOS";
    }
}
?>