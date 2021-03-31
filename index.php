<?php
use App\Relation\Application;

if ($_SERVER['argv'][1] === 'build') {
    define('API_URL', '');
    define('FRONT_URL', '');
} else {
    define('API_URL', 'http://localhost:3001');
    define('FRONT_URL', 'http://localhost:3000');
}

require __DIR__ . '/vendor/autoload.php';

$app = new Application();


$app->export();