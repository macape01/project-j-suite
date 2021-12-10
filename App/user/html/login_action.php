<?php

require_once __DIR__ . "/../../../vendor/autoload.php";

use Rakit\Validation\Validator;
use PHPUnit\Framework\TestCase;
use My\Database;
use My\Helpers;

$validator = new Validator();

$validation = $validator->make($_POST + $_FILES, [
    'username'           => 'required|min:6',
//    'name'               => 'required',
//    'lastname'           => 'required',
//    'email'              => 'required|email',
    'password'           => 'required|min:8|regex:/\d/',
//    'passwordrepeat'     => 'required|same:password',
//    'avatar'             => 'required|uploaded_file:1MB,jpg,png,gif',
]);

$validation->validate();

if ($validation->fails()) {
    $url = Helpers::url("/user/html/register.php");
    Helpers::redirect($url);
} 
else {
    echo "Success!";
}
?>