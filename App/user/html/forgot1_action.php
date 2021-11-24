
<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use Rakit\Validation\Validator;

$validator = new Validator;

// make it
$validation = $validator->make($_POST + $_FILES, [
    'email'                 => 'required|email',
    
]);
$validation->validate();

if ($validation->fails()) {
    $url = My\Helpers::url("/user/html/user.forgot02.php");
    My\Helpers::redirect($url);
    
} else {
    // easy to access POST variables
    $email = $_POST["email"];
    /* $img = $_POST["img"];
    $username = $_POST["username"];
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $old_password = $_POST["old-password"];
    $new_password = $_POST["new-password"];
    $repeat_password = $_POST["repeat-password"]; */

    $db = new My\Database();
    $sentencia = $db->prepare("SELECT user FROM users WHERE email = '".$email."'");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    echo $contador;
    if ( $contador >= 1 ){
        echo "El email ya existe";
    }
    else{
        echo" Esta bien";
    }
    echo "Success!";
}



// $sen = $db->prepare("SELECT email,role_id FROM users WHERE username = 'admin'");
//         if (isset($sen) ){
//             echo"si";
//         }else{
//             echo "no";
//         }


// $message = "wrong answer";
//     echo "<script type='text/javascript'>alert('$message');</script>";