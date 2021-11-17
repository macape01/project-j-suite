<?php

require('/../../../../vendor/autoload.php');

use Rakit\Validation\Validator;

$validator = new Validator;


$validation = $validator->make($_POST + $_FILES, [
    'email'                 => 'required|email'
    
]);

$validation->validate();

if ($validation->fails()) {
    // se produce error
    $errors = $validation->errors();
    echo "<pre>";
    print_r($errors->firstOfAll());
    echo "</pre>";
    exit;
} else {
    // validation passes
    echo "Success!";

}
