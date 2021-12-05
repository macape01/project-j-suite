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

if ($validation->fails()) {
    $url = Helpers::url("/user/html/user.profile.php");
    Helpers::redirect($url);
    
} 
else {
    // easy to access POST variables
    $img = $_POST["img"];
    $email = $_POST["email"];
    $old_password = $_POST["old-password"];
    $new_password = $_POST["new-password"];
    //Aqui deberiamos comprobar si la contraseña antigua es correcta(no lo acabo de hacer pporque no se como se descifra una contra)
    /* if ( isset($_POST["old-password"]) && isset($_POST["new-password"]) && isset($_POST["repeat-password"]) ){
        $db = new Database();
        $sentencia = $db->prepare("SELECT 'password' FROM users WHERE email = '{$email}' and 'password' = '${old_password}' ;");
    } */
    //Comprovem que no existeix l'email
    $db = new Database();
    $sentencia = $db->prepare("SELECT user FROM users WHERE email = '{$email}';");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    $db->close();
    if ( $contador >= 1 ){
        echo "El email ya existe";
        Helpers::redirect($url);
        //Mostrar mensaje error
    }
    else{
        //Hash password
        $password = hash("sha256",$new_password);
        $db = new Database();
        $sentencia = $db->prepare("UPDATE users SET email='${$email}' 'status'=0 'password'='${$password}' WHERE email = '{$email}';");
        $sentencia->execute();
        $db->close();

        //Token
        $db = new Database();
        $bytes = random_bytes(20);
        $token = bin2hex($bytes);
        $sql = "INSERT INTO user_tokens (token, 'type' ) VALUES ('$token', 'A')";
        $sentencia2 = $db->prepare($sql);
        $sentencia2->execute();
        My\Helpers::log()->debug("TOKEN SUBIDO A YUTUB PERFESTO");
        $db->close();

        //Email
        //Afegim token a la query url
        $url = Helpers::url("/user/html/user.register_action2.php");
        $query = parse_url($url, PHP_URL_QUERY);
        // Returns a string if the URL has parameters or NULL if not
        if ($query) {
            $url .= '&token='.$token;
        } else {
            $url .= '?token='.$token;
        }

        $link = "Link";
        $subject = "Account profile updated:";
        $body = "{$url}";
        $isHtml = true;

        $to = ["2daw.equip01@fp.insjoaquimmir.cat"];
        $SendMail = new Mail($subject, $body, $isHtml);
        $send = $SendMail->send($to);

        $url = Helpers::url("/user/html/register.php");
        Helpers::redirect($url);
        //$url = Helpers::url("/user/html/user.forgot01.php");
        //Helpers::log()->debug($url);
        //Helpers::redirect($url);
        echo" Esta bien";
    }
    
    echo "Success!";
}

