<?php require_once __DIR__ . "/../../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<link rel="stylesheet" href="../css/user.forgot.css">
<body>
   <header>

   </header>
<div class="flex-container">
   <div class="forgot " action="">
      <form action="forgot2_action.php" method="POST">
            <h1>Consulta el teu email</h1>
      </form>
   </div>
</div> 
<?= My\Helpers::render("_commons/footer.php") ?>
</body>
 </html>
