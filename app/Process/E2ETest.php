<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 8:43
 */

namespace App\Process;


use App\Collector\Application;

class E2ETest
{

    public static function execute(Application $app = null)
    {
        self::LoginForm($app);
    }

    private static function LoginForm(Application $app)
    {
        $app->test('LoginForm')
            ->type('.loginFormUsername', 'zbynek.rybicka')
            ->type('.loginFormPassword', 'mojeMilaJulinka')
            ->click('.loginFormSubmit')
            ->checkNot('.LoginForm')
            ->check('.Admin')
            ->screenshot('LoginForm')
            ->end();
    }
}