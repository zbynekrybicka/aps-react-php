<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 8:58
 */

namespace App\Collector;


use App\Meta\E2ETest;

class Application extends Collector
{

    public function test($test, $before = '')
    {
        self::$test = (object) [ 'title' => $test ];
        self::$tests[$test] = new E2ETest(__DIR__ . '/../../cypress/integration/' . $test . '.spec.js', $test, $before, FRONT_URL, self::$documentation);
        return new Cypress;
    }

    public function content()
    {
        return new Component('app');
    }


}