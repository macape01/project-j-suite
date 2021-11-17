<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Login"]) ?>
<body>
   <main class="main">
      <header class="header">
         <div class="logo-wrapper">
            <a class="link link__logo" href="">LOGO</a>
         </div>
         <form class="formulario" action="/form.php">
            <div class="formulario__row2">
               <label class="txt">Usuari:</label>
               <input class="input">
               <div class="check">
                  <input type="checkbox" id="rememberpasswd" name="rememberpasswd">
                  <label for="rememberpasswd">Recordar sesión</label>
               </div>
            </div>
            <div class="formulario__row2">
               <label class="txt">Contrasenya:</label>
               <input class="input">
               <a class="recuperarcontra" href="">Recuperar contrasenya</a>
            </div>
            <input class="button" type="button" value="LOGIN"/>
         </form>
      </header>
      <div class="menu">
         <div class="blocregis">
            <div class="logo">
               <img src="img/logo.png">
            </div>
            <div class="registre">
               <input class="button b3" type="button" value="REGISTRATE"/>
            </div>
         </div>
      </div>
      <section class="section">

      </section>
   <main>
   <?= My\Helpers::render("/_commons/footer.php") ?>
</body>
</html>