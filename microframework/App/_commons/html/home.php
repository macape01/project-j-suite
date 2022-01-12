<!DOCTYPE html>
<html lang="ca">
<?php require_once "../../../vendor/autoload.php"; ?>
<?= My\Helpers::render("_commons/head.php", ["subtitle" => "Main"]) ?>
<body>
   <main class="main">
      <?= My\Helpers::render("_commons/header.php") ?>
      <section class="section">
         <sidebar class="accordion accordion--tools component--round">
            <div class="sidebar__profile">
               <i class="fa fa-user-circle profile-icon icon"></i>       
               <p class="titols text">User Name</p>
            </div>
            <input class="button button--round" type="button" name="2" value="Perfil"/>
            <input class="button button--round" type="button" name="2" value="Settings"/>
            <input class="button button--round" type="button" name="2" value="Calendar"/>
            <input class="button button--round" type="button" name="2" value="Contacts"/>
            <input class="button button--round info" type="button" name="2" value="Informació"/>
         </sidebar>
         <div class="container">
            <div class="tools">
               <div class="tools__item">
                  <i class="fa fa-user-circle profile-icon icon"></i>       
               </div>
               <div class="tools__item">
                  <i class="fa fa-calendar icon"></i>
               </div>
               <div class="tools__item">
                  <i class="fa fa-cog icon"></i>
               </div>
               <div class="tools__item">
                  <i class="fa fa-info-circle icon"></i>
               </div>
            </div>
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
         <sidebar class="accordion accordion--messages component--round">
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
      <?= My\Helpers::render("_commons/footer.php", ["subtitle" => "Main"]) ?>
   <main>
</body>
</html>