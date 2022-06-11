<html <?= (isset($lang)) ? 'lang="' . $lang . '"' : ''; ?>>
<head>
    <title><?= $title; ?></title>
    <?= $this->head(); ?>
</head>
<body>
<div class="wrapper">
    <?= $content; ?>
</div>
<?= $this->footer(); ?>
</body>
</html>