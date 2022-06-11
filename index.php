<?php
include __DIR__.'\autorun.php';

use Core\App;

$params = [
    'config' => include __DIR__ . '/config/config.php',
    'db' => include __DIR__ . '/config/db.php',
    'route' => include __DIR__ . '/config/route.php',
];

$app = new App($params);
$app->run();

?>
