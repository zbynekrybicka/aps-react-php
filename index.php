<?php
use App\Collector\Collector;
use App\Process\E2ETest;
use App\Process\LoginForm;
use App\Process\Init;
use App\Process\Menu;

require __DIR__ . '/vendor/autoload.php';

$application = Init::execute();

$app = $application->content();

$loginForm = $app->condition('loginForm')->selector('isNotLoggedIn')->expression('!*.authToken');

$admin = $app->condition('admin')->selector('isLoggedIn')->expression('*.authToken');
$menu = $admin->component('menu');

LoginForm::execute($loginForm);
Menu::execute($menu);
E2ETest::execute($application);

Collector::export();
