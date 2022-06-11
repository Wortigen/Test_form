<html <?= (isset($lang)) ? 'lang="' . $lang . '"' : ''; ?>>
<head>
    <title><?= $title; ?></title>
    <?= $this->head(); ?>
</head>
<body>
<div class="wrapper_error">
    <? foreach ($errors as $error): ?>
    <div class="item_err">
        <h3><?= $error['title']; ?></h3>
        <p><?= $error['message']; ?></p>
    </div>
    <? endforeach; ?>
</div>
<?= $this->footer(); ?>
</body>
</html>