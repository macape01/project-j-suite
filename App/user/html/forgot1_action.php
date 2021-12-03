
<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use My\Mail;
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
        $bytes = random_bytes(20);
        $token = bin2hex($bytes);
        $sql = "INSERT INTO user_tokens (token, 'type' ) VALUES ('$token', 'R')";
        $sentencia4 = $db->prepare($sql);
        $sentencia4->execute();

        $url_seguent = Helpers::url("/user/html/user.forgot03.php");
        $link = "Link";
        $subject = "Password Reset:";
        $body = "{$url_seguent}";
        $isHtml = true;
        $to = ["2daw.equip01@fp.insjoaquimmir.cat"];
        $SendMail = new Mail($subject, $body, $isHtml);
        $send = $SendMail->send($to);
        $url = Helpers::url("/user/html/user.forgot02.php");
        Helpers::redirect($url);
    }else{
        $url = Helpers::url("/user/html/user.forgot01.php");
        Helpers::log()->debug($url);
        Helpers::redirect($url); 
    }
      
}







        // $url_seguent = Helpers::url("/user/html/user.forgot03.php");
        // $envio = new Mail("Recuperacion", $url);
        // $to = ["dudo@fp.insjoaquimmir.cat"];

        // $res = $envio->send($to);
   
        // $url = Helpers::url("/user/html/user.forgot03.php");
        // Helpers::log()->debug($url);
        // Helpers::redirect($url);   
