<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 8:55
 */

namespace App\Collector;


class Cypress extends Collector
{

    public function type(string $element, string $type)
    {
        self::$tests[self::$test->title]->type($element, $type);
        return new Cypress;
    }

    public function click(string $element)
    {
        self::$tests[self::$test->title]->click($element);
        return new Cypress;
    }

    public function check(string $element)
    {
        self::$tests[self::$test->title]->check($element);
        return new Cypress;
    }

    public function checkNot(string $element)
    {
        self::$tests[self::$test->title]->checkNot($element);
        return new Cypress;
    }

    public function screenshot(string $element)
    {
        self::$tests[self::$test->title]->screenshot($element);
        return new Cypress;
    }

    public function end()
    {
        return new Application;
    }

}