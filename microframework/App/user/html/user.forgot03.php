<?php require_once __DIR__ . "/../../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<link rel="stylesheet" href="../css/user.forgot.css">
<body>
    <?php My\Helpers::log()->debug('token'.$_GET['token']);?>
   <div class="flex-container">
    <div class="forgot forgot--change">
        <form action="forgot2_action.php" method="POST">
            <input name="token" type="hidden" value="<?=$_GET['token']?>">
            <h1>Recuperación de contraseña</h1>
            <label class="la">Introduce la nueva contraseña:</label>
            <input name="contra1" class="row__wrapper input--forgot" type="password">
            <label class="la">Repite la nueva contraseña:</label>
            <input name="contra2" class="row__wrapper input--forgot" type="password">
            <input class="button button--round" type="submit" value="Continua">
        </form>
    </div>
 </div> 
 <?= My\Helpers::render("_commons/footer.php") ?>
</body>
 </html>