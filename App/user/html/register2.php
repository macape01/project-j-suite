<?php require_once __DIR__ . "/../../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ca">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" type='text/css'>
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
                <input class="button b2" type="button" value="LOGIN"/>
            </form>
        </header>
        <div class="mockup-container">
    <div class="container2">
        <form class="form component--round">
            <div class="form__row">
                <label class="label">Nom</label>
                <div class="row__wrapper">
                    <i class="fa fa-user icon"></i>
                    <input class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Cognoms</label>
                <div class="row__wrapper">
                    <i class="fa fa-user icon"></i>
                    <input class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Contrasenya</label>
                <div class="row__wrapper">
                    <i class="fa fa-lock icon"></i>
                    <input class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Repeteix la contrasenya</label>
                <div class="row__wrapper">
                    <i class="fa fa-lock icon"></i>
                    <input class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Correu</label>
                <div class="row__wrapper">
                    <i class="fa fa-envelope icon"></i>
                    <input class="input">
                </div>
            </div>
            <div class="form__row">
                <div class="row__wrapper row__wrapper--checkbox">
                    <input type="checkbox" class="input--checkbox">
                    <label class="label">Acceptar <a href="#">termes i condicions</a></label>
                </div>
            </div>
            <div class="form__row">
                <div class="button__wrapper">
                    <button class="button b2">REGISTRE</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <section class="section">
    </section>
    <main>
</body>
<?= My\Helpers::render("/_commons/footer.php") ?>