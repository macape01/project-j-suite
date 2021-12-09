
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
        //INSERT INTO user_tokens (user_id, token, type, created) VALUES (2, 'c8075b7429f1b6b03a3072797df4a7cd2bf87155', 'R', now());
        $sql = "INSERT INTO user_tokens (token, 'type' ) VALUES ('c8075b7429f1b6b03a3072797df4a7cd2bf87155', 'R')";
        Helpers::log()->debug($sql);
        $sentencia = $db->prepare($sql);
        $sentencia->execute();
        My\Helpers::log()->debug("TOKEN SUBIDO A YUTUB PERFESTO");

        $url_seguent = Helpers::url("/user/html/forgot2_action.php?token=". $token);
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
