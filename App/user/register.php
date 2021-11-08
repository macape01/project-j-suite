<!DOCTYPE html>
<html lang="ca">
<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Login"]) ?>
<body>
   <?= My\Helpers::render("/_commons/header.php") ?>
   <h2>Sign up</h2>
   <p>Create an account.</p>
   <?= My\Helpers::render("/_commons/footer.php") ?>
</body>
</html>