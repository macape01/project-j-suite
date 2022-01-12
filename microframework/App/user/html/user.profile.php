<?php 
    require_once "../../../vendor/autoload.php"; 
    use My\Database;
    $db = new Database();
    //Este id deberia ser el que viene de la sesion actual
    $sentencia = $db->prepare("SELECT id, username, email, avatar_id, role_id FROM users WHERE id = 1;");
    $sentencia->execute();
    $results = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $user = $results[0];
    My\Helpers::log()->debug($user->avatar_id);
    $db->close();

    /* $db = new Database();
    $new_password = hash("sha256","admin");
    //Este id deberia ser el que viene de la sesion actual
    $sentencia = $db->prepare("UPDATE users SET password = '{$new_password}' WHERE id = 1");
    $sentencia->execute();
    $db->close(); */
    //8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918
    

    $db = new Database();
    $sentencia1 = $db->prepare("SELECT filepath FROM files WHERE id = '{$user->avatar_id}';");
    $sentencia1->execute();
    $results2 = $sentencia1->fetchAll(PDO::FETCH_OBJ);
    $file = $results2[0];
    $avatarurl = My\Helpers::avatarUrl($file->filepath);
    My\Helpers::log()->debug($avatarurl);
    //My\Helpers::log()->debug("Datos");
?>


<!DOCTYPE html>
<html lang="en">
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<body>
    <main class="main">
      <?= My\Helpers::render("_commons/header.php") ?>
      <section class="section">
        <sidebar class="accordion component--round">
            <p class="titols text">User Name</p>
            <img src="<?= $avatarurl ?>"></img>
            <!-- <i class="fa fa-user-circle profile-icon">       
            </i> -->

            <input class="button button--round" type="button" name="2" value="Perfil"/>
            <input class="button button--round" type="button" name="2" value="Settings"/>
            <input class="button button--round" type="button" name="2" value="Calendar"/>
            <input class="button button--round" type="button" name="2" value="Contacts"/>
            <input class="button button--round info" type="button" name="2" value="Informació"/>
        </sidebar>
        <form class="form component--round" action="user.profile_action.php" enctype="multipart/form-data" method="POST">
            <h1>Perfil d'usuari</h1>
            <input name="id" style="display:none;" value="<?= $user->id ?>"/>
            <div class="form__row">
                <label class="label">Canviar foto perfil</label>
                <div class="row__wrapper">
                    <input name="avatar" class="input" type="file" alt="choose-image">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Usuari</label>
                <div class="row__wrapper">
                    <i class="fa fa-user icon"></i>
                    <input name="username" type="text" readonly value="<?= $user->username ?>" class="input">
                </div>
            </div>
            <div class="form__row">
                <label class="label">Correu</label>
                <div class="row__wrapper">
                    <i class="fa fa-envelope icon"></i>
                    <input type="email" required name="email" value="<?= $user->email ?>" class="input">
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