<html <?= (isset($lang)) ? 'lang="' . $lang . '"' : ''; ?>>
<head>
    <title><?= $title; ?></title>
    <?= $this->head(); ?>
</head>
<body>
<div class="wrapper d-md-flex">
    <?= $content; ?>
</div>
<?= $this->footer(); ?>
</body>
</html>