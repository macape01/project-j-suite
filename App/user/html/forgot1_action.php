
<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use Rakit\Validation\Validator;

$validator = new Validator();

// make it

$validation = $validator->make($_POST + $_FILES, [
    'email'                 => 'required|email',
]);

$validation->validate();

if ($validation->fails()) {
    $url = Helpers::url("/user/html/user.forgot01.php");
    Helpers::log()->debug($url);
    Helpers::redirect($url);
    
} else {
    $email = $_POST["email"];
    $db = new Database();
    $sentencia = $db->prepare("SELECT * FROM users WHERE email= '{$email}';");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    if ( $contador >= 1 ){
        $url_seguent = Helpers::url("/user/html/user.forgot03.php");
        $envio = new Mail($url);
        $res = $envio->send(
            ["prueba" => "dudo@fp.insjoaquimmir.cat"] 
        );
        // $url = Helpers::url("/user/html/user.forgot03.php");
        // Helpers::log()->debug($url);
        // Helpers::redirect($url);    
    }
    $url = Helpers::url("/user/html/user.forgot01.php");
    Helpers::log()->debug($url);
    Helpers::redirect($url);   
}