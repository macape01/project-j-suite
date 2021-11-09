<!DOCTYPE html>
<html lang="ca">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Projecte J-Suite</title>
   <link href="http://localhost/tarda/project-j-suite/App/_commons/css/layout.css" rel="stylesheet" type="text/css">
   <link href="http://localhost/tarda/project-j-suite/App/_commons/css/reset.css" rel="stylesheet" type="text/css">
</head>
<body>
   <main class="main">
      <header class="header">
         <h1><a href="<?= $_SERVER['SCRIPT_NAME']?>">Projecte J-Suite</a></h1>
      </header>
      <section class="section">
         <aside class="aside">
         </aside>
         <div class="container">
            <div class="container__item chatapp"></div>
            <div class="container__item tickets"></div>
            <div class="container__item tasks"></div>
            <div class="container__item security"></div>
            <div class="container__item inventory"></div>
            <div class="container__item delivery"></div>
         </div>
         <aside class="asidehover">
         </aside>
      </section>
      <footer class="footer">
         <p>Curs 2021-22 de 2DAW</p>
      </footer>
   <main>
</body>
</html>