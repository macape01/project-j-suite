<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecte J-Suite / <?= $__params["subtitle"] ?? "" ?></title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/reset.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/styles.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/components.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/layout.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/user/css/user.register.css")?>"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= My\Helpers::url("/user/css/user.forgot.css")?>"/>
</head>
<?php $flash = My\Helpers::flash(); ?>
<?php if (!empty($flash)): ?>
<div class="flash">
    <ul>
        <?php foreach ($flash as $msg): ?>
        <li class="flash__message"><?= $msg ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>