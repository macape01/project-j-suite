<?php 

require_once __DIR__ . "/../../../vendor/autoload.php"; 

use My\Database;
use My\Helpers;
use My\Mail;
use Rakit\Validation\Validator;

function LoadFlash(string $msg):void{
    Helpers::flash($msg);
}

function Redirect(string $url):void{
    $new_url = Helpers::url($url);
    Helpers::redirect($new_url);
}

/* function UploadAvatar($username,$avatar){

    Helpers::upload($avatar,$username);
} */

function EmailHasUpdated(string $email, string $id):bool{
    $db = new Database();
    $sentencia = $db->prepare("SELECT username FROM users WHERE email = '{$email}' and id = '{$id}';");
    // 0 -> ha cambiado 1-> no ha cambiado
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    $db->close();
    //Si el contador es igual a 0, el email ha sido actualizado
    if ( $contador == 0) return true;
    return false;
}
function EmailIsAvailable(string $email, string $id):bool{
    $db = new Database();
    $sentencia = $db->prepare("SELECT username FROM users WHERE email = '{$email}' and id != '{$id}';");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    $contador = count($result);
    $db->close();
    //Si el contador es igual a 1, el email ya esta siendo usado por otro usuario
    return $contador == 0;
}

function OldPasswordIsTheSame($old_password,$id){
    $db = new Database();
    $sentencia = $db->prepare("SELECT username, password FROM users WHERE id = '{$id}' and password = '{$old_password}';");
    $sentencia->execute();
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $user = $result[0];
    Helpers::log()->debug($user->password);
    $contador = count($result);
    $db->close();
    return $contador == 1;
}

function GetPassword($id){
    $db = new Database();
    $sentencia = $db->prepare("SELECT password FROM users WHERE id = '{$id}';");
    $sentencia->execute();
    $results = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $user = $results[0];
    $old_password = $user->password;
    if ( !empty($_POST["old-password"]) && !empty($_POST["new-password"]) && !empty($_POST["repeat-password"])){
        Helpers::log()->debug("entroooo");
        if ( !OldPasswordIsTheSame($old_password, $id )){
            Helpers::log()->debug("oldpassnotsame");
            //LoadFlash("La contraseña antigua no es correcta");
            //Redirect("/user/html/user.profile.php");
        }
        $new_password = hash("sha256",$_POST["new-password"]);
        //Helpers::log()->debug("old".$old_password);
        //Helpers::log()->debug("new".$new_password);
        return $new_password;
    }
    return $old_password;
}

function UpdateUserData($query){
    $db = new Database();
    $sentencia = $db->prepare($query);
    $sentencia->execute();
    $db->close();
}

function CreateToken(){
    $db = new Database();
    $bytes = random_bytes(20);
    $token = bin2hex($bytes);
    $sql = "INSERT INTO user_tokens (token, 'type' ) VALUES ('$token', 'A')";
    $sentencia = $db->prepare($sql);
    $sentencia->execute();
    My\Helpers::log()->debug("TOKEN SUBIDO A YUTUB PERFESTO");
    $db->close();
    return $token;
}

function AddTokenToQuery($token, $url){
    $query = parse_url($url, PHP_URL_QUERY);
    // Returns a string if the URL has parameters or NULL if not
    if ($query) {
        $url .= '&token='.$token;
    } else {
        $url .= '?token='.$token;
    }
    return $url;
}

function CreateEmail($link,$subject,$body,$isHtml){
    $link = $link;
    $subject = $subject;
    $body = "{$body}";
    $isHtml = $isHtml;
    $to = ["2daw.equip01@fp.insjoaquimmir.cat"];
    $SendMail = new Mail($subject, $body, $isHtml);
    $send = $SendMail->send($to);
}

$validator = new Validator;

// make it
$validation = $validator->make($_POST + $_FILES, [
    'email'                 => 'required|email',
    'username'              => 'required',
    'avatar'                => 'uploaded_file:0,500K,png,jpeg',
    'old-password'          => 'required',
    'new-password'          => 'required|different:old-password',
    'repeat-password'       => 'same:new-password',
]);



// then validate
$validation->validate();

if ($validation->fails()) {
    LoadFlash("La validació ha fallat...");
    Redirect("/user/html/user.profile.php");
} 
else {
    //Aqui deberiamos comprobar si la contraseña antigua es correcta(no lo acabo de hacer pporque no se como se descifra una contra)
    $email = $_POST["email"];
    $id = $_POST["id"];
    /*$image_array = $_FILES["avatar"];
    $ruta = Helpers::upload($_FILES["avatar"],$_POST["username"]);
    Helpers::log()->debug("ruta".$ruta);
    $db = new Database();
    $sql = "INSERT INTO files (filepath, filesize, uploaded) VALUES ('{$ruta}', '{$image_array["size"]}', now() )";
    $sentencia = $db->prepare($sql);
    $sentencia->execute();
    $last_id = $db->lastInsertId();
    Helpers::log()->debug($last_id);
    $db->close(); */

    //Comprovem que l'email no ha estat actualitzat
    if ( EmailHasUpdated($email,$id) == true ){
        if ( !EmailIsAvailable($email,$id) ){
            LoadFlash("El email introducido ya existe en la base de datos");
            Helpers::log()->debug("El nuevo email no esta disponible");
            Redirect("/user/html/user.profile.php");
        }
        //Obtenim una contrasenya, ja pot ser una nova o la mateixa que estava abans, en qualsevol cas fem update de la contra per no haver de fer dos casuistiques
        $password = GetPassword($id);
        Helpers::log()->debug($password);

        $ruta = Helpers::upload($_FILES["avatar"],$_POST["username"]);

        $query = "UPDATE users SET email='{$email}', status=0, avatar_id = '{$ruta}' password='{$password}' WHERE id = '{$id}';";
        UpdateUserData($query);
        Helpers::log()->debug("La cuenta ha sido actualizada");
        //Afegim token a la query url
        $token = CreateToken();
        $url = Helpers::url("/user/html/user.register_action2.php");
        $new_url = AddTokenToQuery($token,$url);
        CreateEmail("Link","Account profile updated",$new_url,true);
        $url = Helpers::url("/user/html/register.php");
        Helpers::redirect($url);
    }
    $password = GetPassword($id);
    Helpers::log()->debug("password".$password);
    $query = "UPDATE users SET password='{$password}' WHERE id = '{$id}' ;";
    UpdateUserData($query);
    Helpers::log()->debug("La cuenta ha sido actualizada");
    $url = Helpers::url("/user/html/user.profile.php");
    Helpers::redirect($url);
}

