<?php

require('vendor/autoload.php');

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;

$validator = new Validator;

// make it
$validation = $validator->make($_POST + $_FILES, [
    'username'           => 'required|min:6',
    'name'               => 'required',
    'lastname'           => 'required',
    'email'              => 'required|email',
    'password'           => 'required|min:8|regex:/\d/',
    'passwordrepeat'     => 'required|same:password',
    'avatar'             => 'required|uploaded_file:1MB,jpg,png,gif',
]);

// then validate
$validation->validate();

if ($validation->fails()) {
    // handling errors
    $errors = $validation->errors();
    echo "<pre>";
    print_r($errors->firstOfAll());
    echo "</pre>";
    exit;
} 
else {
    // validation passes
    echo "Success!";
}

$email = $_POST['email'];
$username = $_POST['username'];

$db = new Database();
$this->assertIsObject($db);
return $db;

$comprobarNom = $db->prepare("SELECT email FROM users WHERE email = '".$email."'");
$comprobarMail = $db->prepare("SELECT username FROM users WHERE username = '".$username."'");


?>