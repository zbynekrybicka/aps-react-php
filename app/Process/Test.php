<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 21:05
 */

namespace App\Process;


use App\Relation\IComponent;

class Test implements IProcess
{

    public static function execute(IComponent $app = null)
    {
        $app->test('LoginForm')
            ->type('.loginFormUsername', 'zbynek.rybicka')
            ->type('.loginFormPassword', 'mojeMilaJulinka')
            ->click('.loginFormSubmit')
            ->screenshot('afterLogin');
    }
}