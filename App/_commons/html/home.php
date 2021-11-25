<!DOCTYPE html>
<html lang="ca">
<?php require_once "../../../vendor/autoload.php"; ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" type='text/css'>
<?= My\Helpers::render("/_commons/head.php", ["subtitle" => "Main"]) ?>
<body>
   <main class="main">
      <?= My\Helpers::render("/_commons/header.php") ?>
      <section class="section">
         <aside class="aside">
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
         </aside>
         <div class="container">
            <div class="container__item chatapp">
               Chatapp
            </div>
            <div class="container__item tickets">
               Tickets
            </div>
            <div class="container__item tasks">
               Tasks
            </div>
            <div class="container__item security">
               Security
            </div>
            <div class="container__item inventory">
               Inventory
            </div>
            <div class="container__item delivery">
               Delivery
            </div>
         </div>
         <aside class="asidehover">
            <sidebar class="accordion component--round">
                <h2 class="accordion__title">MISSATGES</h2>
                <div class="messages">
                    <div class="messages__author">
                        Marc
                    </div>
                    <div class="messages__subject">
                        Buenas que tal todo?
                    </div>
                    <div class="messages__date">
                        Enviat a les 22:00h avui
                    </div>
                </div>
                <div class="messages">
                    <div class="messages__author">
                        Oliver
                    </div>
                    <div class="messages__subject">
                        Buenas que tal va la vida?
                    </div>
                    <div class="messages__date">
                        Enviat a les 12:00h avui
                    </div>
                </div>
            </sidebar>
         </aside>
      </section>
      <?= My\Helpers::render("/_commons/footer.php", ["subtitle" => "Main"]) ?>
   <main>
</body>
</html>