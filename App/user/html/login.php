<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">

<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Login"]) ?>
<body>
   <?= My\Helpers::render("/_commons/header.php") ?>
   <h2>Sign in</h2>
   <p>Welcome back!</p>
   <?= My\Helpers::render("/_commons/footer.php") ?>
</body>
</html>