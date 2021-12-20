<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Helpers;
use My\Database;
use My\Token;
use My\Mail;
use My\User;

$url = Helpers::url("/user/html/login.php"); // Go to homepage

$validator = new Validator();

$validation = $validator->make($_POST, [
    'username'           => 'required',
    'password'           => 'required|min:8|regex:/\d/',
]);

$validation->validate();

if ($validation->fails()) {
    $errors = $validation->errors();
    $messages = $errors->all();
    foreach ($messages as $message) {
        Helpers::flash($message);
    }
    Helpers::redirect($url);

} else {
    $username = $_POST["username"];
    $password = hash("sha256", $_POST["password"]);
    $remember = $_POST["remember"];
    try {
        Helpers::log()->debug("Verificant nom d'usuari i contrasenya");
        $db = new Database();
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        Helpers::log()->debug($sql);
        $sentencia = $db->prepare($sql);
        $sentencia->execute();
        
        if ($user = $sentencia->fetch()) {
            Helpers::log()->debug("Usuari OK");
            $datetime = date('Y-m-d H:i:s');
            $uid = $user["id"];
            $sql = "UPDATE users SET last_access='$datetime' WHERE id=$uid";
            $sentencia2 = $db->prepare($sql);
            $sentencia2->execute();

            if ($sentencia2 == true){
                Helpers::log()->debug("Ultim accés de l'usuari ACTUALITZAT");
                // Create user session token
                $idtoken=$uid;
                $bytes = random_bytes(20);
                $token = bin2hex($bytes);
                $sql = "INSERT INTO user_tokens (token, type, user_id, created) VALUES ('$token', 'S', $idtoken, '$datetime')";
                Helpers::log()->debug($sql);
                $sentencia3 = $db->prepare($sql);
                $sentencia3->execute();

                if ($sentencia3 == true){
                    // Create user session cookie
                    $plus = $remember ? 3600*24*7*4*2 : 3600;
                    setcookie(User::COOKIE_NAME, $token, time() + $plus);
                    Helpers::log()->debug("Benvingut ".htmlspecialchars($_COOKIE["session_token"]));
                    session_start();
                    $_SESSION[User::COOKIE_NAME]=$sesioncookie;
                    Helpers::log()->debug($sesioncookie);
                    Helpers::flash("Login fet amb session cookie");
                    Helpers::redirect($url);
                } else {
                    Helpers::log()->debug("No aconseguim inserir el token Session");
                }
            } else {
                Helpers::log()->debug("No aconseguim actualitzar l'hora d'ultim accés");
            }
        } else {
            Helpers::log()->debug("Invalid username and password");
            Helpers::flash("Error de credencials. Prova de nou");
        }
    } catch (PDOException $e) {
        Helpers::log()->debug($e->getMessage());
        Helpers::flash("No s'han pogut enviar les dades. Prova-ho més tard.");
    } catch (Exception $e) {
        Helpers::log()->debug($e->getMessage());
        Helpers::flash("Hi hagut un error inesperat. Prova-ho més tard.");
    }
}
Helpers::redirect($url);

?>