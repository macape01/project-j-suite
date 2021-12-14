
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

    $sql = "SELECT id FROM users WHERE email='$email'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $uid = $stmt->fetchColumn();
    

    if ( $contador >= 1 ){
        $date = date('Y-m-d H:i:s');
        $bytes = random_bytes(20);
        $token = bin2hex($bytes);
        $sql = "INSERT INTO user_tokens (token, type, user_id, created) VALUES ('$token', 'R', $uid, '{$date}')"; //Preguntar como sacar la id, despues de hacer un isert de un nuevo usuario
        $sentencia5 = $db->prepare($sql);
        $sentencia5->execute();
        Helpers::log()->debug($sql);
        if ($sentencia5 == true){
            My\Helpers::log()->debug("TOKEN SUBIDO A YUTUB PERFESTO");
            $url_seguent = Helpers::url("/user/html/user.forgot03.php?token=". $token);
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
            My\Helpers::log()->debug("TOKEN NO SE SUBIO");
        }
        
    }else{
        $url = Helpers::url("/user/html/user.forgot01.php");
        Helpers::log()->debug($url);
        Helpers::redirect($url); 
    }
      
}


