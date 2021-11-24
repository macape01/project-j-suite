<!DOCTYPE html>
<html lang="en">
<?php require_once "../../../vendor/autoload.php"; ?>
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<body>
    <main class="main">
      <?= My\Helpers::render("_commons/header.php") ?>
      <section class="section">
        <sidebar class="accordion component--round">
            <i class="fa fa-user-circle profile-icon">       
                <p class="titols text">User Name</p>
            </i>

            <input class="button button--round" type="button" name="2" value="Perfil"/>
            <input class="button button--round" type="button" name="2" value="Settings"/>
            <input class="button button--round" type="button" name="2" value="Calendar"/>
            <input class="button button--round" type="button" name="2" value="Contacts"/>
            <input class="button button--round info" type="button" name="2" value="Informació"/>
        </sidebar>
        <form class="form component--round" action="user.profile_action.php" method="POST">
            <h1>Perfil d'usuari</h1>
            <div class="form__row">
                <label class="label">Canviar foto perfil</label>
                <div class="row__wrapper">
                    <input name="img" class="input" type="file" alt="choose-image">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Usuari</label>
                <div class="row__wrapper">
                    <i class="fa fa-user icon"></i>
                    <input name="username" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Nom</label>
                <div class="row__wrapper">
                    <i class="fa fa-user icon"></i>
                    <input name="name" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Cognoms</label>
                <div class="row__wrapper">
                    <i class="fa fa-user icon"></i>
                    <input name="lastname" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Correu</label>
                <div class="row__wrapper">
                    <i class="fa fa-envelope icon"></i>
                    <input name="email" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Antigua contraseña</label>
                <div class="row__wrapper">
                    <i class="fa fa-lock icon" aria-hidden="true"></i>
                    <input type="password" name="old-password" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Nueva contraseña</label>
                <div class="row__wrapper">
                    <i class="fa fa-lock icon" aria-hidden="true"></i>
                    <input type="password" name="new-password" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Repite contraseña</label>
                <div class="row__wrapper">
                    <i class="fa fa-lock icon" aria-hidden="true"></i>
                    <input type="password" name="repeat-password" class="input">
                </div>
            </div>
            
            <div class="form__row" >
                <div class="button__wrapper">
                    <button type="submit" class="button">Cambiar los datos</button>
                </div>
            </div>
        </form>
        <sidebar class="accordion component--round">
            <h2 class="accordion__title">MISSATGES</h2>
            <div class="message">
                <div class="message__author">
                    Marc
                </div>
                <div class="message__subject">
                    Buenas que tal todo?
                </div>
                <div class="message__date">
                    Enviat a les 22:00h avui
                </div>
            </div>
            <div class="message">
                <div class="message__author">
                    Oliver
                </div>
                <div class="message__subject">
                    Buenas que tal va la vida?
                </div>
                <div class="message__date">
                    Enviat a les 12:00h avui
                </div>
            </div>
        </sidebar>
      </section>
      <?= My\Helpers::render("_commons/footer.php") ?>
     <main>
</body>
</html>