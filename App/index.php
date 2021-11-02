<!DOCTYPE html>
<html lang="ca">
<head>
    <?php require_once __DIR__ . "../../vendor/autoload.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header>
        <h1><a href="<?= My\Helpers::url("/")?>">Projecte J-Suite</a></h1>
        <?php $flash = My\Helpers::flash();?>
        <?php if (!empty($flash)): ?>
        <div class="flash">
        <ul>
            <?php foreach ($flash as $msg): ?>
            <li class="flash__message"><?= $msg ?></li>
            <?php endforeach; ?>
        </ul>
        </div>
        <?php endif; ?>
    </header>
   <h2>Homepage</h2>
   <p>My first PHP web app works!</p>
   <ul>
       <li>Operative system: <?= PHP_OS ?></li>
       <li>Web server: <?= $_SERVER['SERVER_SOFTWARE'] ?></li>
       <li>PHP version: <?= phpversion() ?></li>
       <li>IP address: <?= getHostByName(getHostName()) ?></li>
   </ul>
   <footer>
        <p>Curs 2021-22 de 2DAW</p>
    </footer>
</body>
</html>