<?php require_once __DIR__ . "/../../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<link rel="stylesheet" href="../css/user.forgot.css">
<body>
   <header>

   </header>
   <div class="flex-container">
    <div class="forgot forgot--change" action="">
        <form action="forgot2_action.php" method="POST">
            <h1>Recuperación de contraseña</h1>
            <label class="la">Introduce la nueva contraseña:</label>
            <input class="row__wrapper input--forgot" type="text">
            <label class="la">Repite la nueva contraseña:</label>
            <input class="row__wrapper input--forgot" type="text">
            <input class="button button--round"type="button" value="Continua">
        </form>
    </div>
 </div> 
 <?= My\Helpers::render("_commons/footer.php") ?>
</body>
 </html>