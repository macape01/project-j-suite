<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecte J-Suite / <?= $__params["subtitle"] ?? "" ?></title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/reset.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/styles.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/components.css")?>"/>
    <link rel="stylesheet" href="<?= My\Helpers::url("/_commons/css/layout.css")?>"/>
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