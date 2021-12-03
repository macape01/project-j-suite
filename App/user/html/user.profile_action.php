<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use Rakit\Validation\Validator;

$validator = new Validator;

// make it
$validation = $validator->make($_POST + $_FILES, [
    'email'                 => 'required|email',
    'img'                   => 'required|uploaded_file:0,500K,png,jpg,gif,jpeg',
    'old-password'          => 'required|min:8|regex:/\d/',
    'new-password'          => 'required|min:8|regex:/\d/|different:old-password',
    'repeat-password'       => 'required|same:new-password',
    ]);
    
// then validate
$validation->validate();
    
// Url
$url = Helpers::url("/user/html/user.profile.php");


if ($validation->fails()) {
    Helpers::redirect($url);
    
} else {
    // easy to access POST variables
    $email = $_POST["email"];
    /* $img = $_POST["img"];
    $repeat_password = $_POST["repeat-password"];
    $username = $_POST["username"];];
    $old_password = $_POST["old-password"];
    $new_password = $_POST["new-password"];
     */

    //Comprovem que no existeix l'email
    $db = new Database();
    $sentencia = $db->prepare("SELECT user FROM users WHERE email = '{$email}';");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    echo $contador;
    if ( $contador >= 1 ){
        echo "El email ya existe";
        Helpers::redirect($url);
    }
    else{
        $db = new Database();
        $sentencia = $db->prepare("SELECT user FROM users WHERE email = '{$email}';");
        $sentencia->execute();
        echo" Esta bien";
    }
    echo "Success!";
}

