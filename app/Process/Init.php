<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 6:50
 */

namespace App\Process;


use App\Collector\Application;
use App\Collector\Collector;
use App\Collector\Component;
use App\Meta\Documentation;

class Init implements IProcess
{

    public static function execute(Component $component = null)
    {
        if ($_SERVER['argv'][1] ?? '' === 'build') {
            define('API_URL', '');
            define('FRONT_URL', '');
        } else {
            define('API_URL', 'http://localhost:3001');
            define('FRONT_URL', 'http://localhost:3000');
        }
        Collector::$documentation = new Documentation(__DIR__ . '/../../documentation/index.html');
        Collector::$slice = new \App\Meta\Slice(__DIR__ . '/../../dist/front/src/app/appSlice.js', 'app');
        Collector::$api = new \App\Meta\Api(__DIR__ . '/../../dist/api/index.php');
        return new Application();
    }
}