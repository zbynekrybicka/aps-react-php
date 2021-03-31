<?php
use App\Process\LoginForm;
use App\Process\Test;
use App\Relation\Application;

if ($_SERVER['argv'][1] === 'build') {
    define('API_URL', '');
    define('FRONT_URL', '');
} else {
    define('API_URL', 'http://localhost:3001');
    define('FRONT_URL', 'http://localhost:3000');
}

require __DIR__ . '/vendor/autoload.php';

$application = new Application;
$app = $application->content();

$loginForm = $app->condition('LoginForm')
    ->selector('isNotLoggedIn')
    ->expression('!*.authToken');

$admin = $app->condition('Admin')
    ->selector('isLoggedIn')
    ->expression('*.authToken');

$menu = $app->component('menu');

LoginForm::execute($loginForm);


Test::execute($app);


$application->export();