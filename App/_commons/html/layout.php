<!DOCTYPE html>
<html lang="ca">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Projecte J-Suite</title>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   <link href="http://localhost/tarda/project-j-suite/App/_commons/css/layout.css" rel="stylesheet" type="text/css">
   <link href="http://localhost/tarda/project-j-suite/App/_commons/css/reset.css" rel="stylesheet" type="text/css">
   <link href="http://localhost/tarda/project-j-suite/App/_commons/css/styles.css" rel="stylesheet" type="text/css">
   <link href="http://localhost/tarda/project-j-suite/App/_commons/css/components.css" rel="stylesheet" type="text/css">
</head>
<body>
   <main class="main">
      <header class="header">
         <div class="logo-wrapper">
            <a class="link link__logo" href="">LOGO</a>
         </div>
         <div class="icons-wrapper">
            <a href=""><i class="fa fa-bell icon"></i></a>
            <a href=""><i class="fa fa-flag icon"></i></a>
            <a href=""><i class="fa fa-question-circle icon"></i></a>
            <a href=""><i class="fa fa-sign-out icon" aria-hidden="true"></i></a>
         </div>
      </header>
      <section class="section">
         <aside class="aside">
         <sidebar class="accordion component--round">
            <i class="fa fa-user-circle profile">       
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
               <a><i class="fa fa-clipboard-list icon"></i></a>
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
         </aside>
      </section>
      <footer class="footer">
         <p>Curs 2021-22 de 2DAW</p>
      </footer>
   <main>
</body>
</html>