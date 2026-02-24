<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

$app = new App\Core\Application();
$app->run();
