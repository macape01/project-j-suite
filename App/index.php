<!DOCTYPE html>
<html lang="ca">
<?php require_once __DIR__ . "../../vendor/autoload.php"; ?>
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Login"]) ?>
<body>
   <?= My\Helpers::render("/_commons/header.php") ?>
   <h2>Homepage</h2>
   <p>My first PHP web app works!</p>
   <ul>
       <li>Operative system: <?= PHP_OS ?></li>
       <li>Web server: <?= $_SERVER['SERVER_SOFTWARE'] ?></li>
       <li>PHP version: <?= phpversion() ?></li>
       <li>IP address: <?= getHostByName(getHostName()) ?></li>
   </ul>
   <?= My\Helpers::render("/_commons/footer.php") ?>
</body>
</html>