<?php require_once __DIR__ . "/../../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<link rel="stylesheet" href="../css/user.forgot.css">
<body>
<div class="flex-container">

   <form class="forgot" action="/rememberpass/forgot1_action.php" method="POST">
           <h1>Recuperación de contraseña</h1>
           <label class="la" name="email">Correo:</label>
           <input class="row__wrapper input--forgot" type="text">
           <p class="la">Se enviará un correo electronico con el PIN</p>
           <input class="button button--round"type="submit">
</form>
</div> 
<?= My\Helpers::render("_commons/footer.php") ?>
</body>
 </html>