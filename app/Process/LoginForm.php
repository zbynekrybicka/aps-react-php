<?php

namespace App\Process;

use App\Relation\IComponent;

class LoginForm implements IProcess
{

    public static function execute(IComponent $loginForm = null)
    {
        if (!$loginForm) {
            throw new ComponentNotFoundException(__CLASS__);
        }
        $loginForm->element('input')
            ->className('loginFormUsername')
            ->param('type')->value('text')
            ->model('loginFormUsername');

        $loginForm->element('input')
            ->className('loginFormPassword')
            ->param('type')->value('password')
            ->model('loginFormPassword');

        $loginForm->element('button')->className('loginFormSubmit')->event('click')
            ->ajax('postLogin')->selector('loginForm')->expression('*.loginForm')
            ->post()->url('/login')->noAuth()->service('user')->method('login')
            ->before('*.preloader = true')->endBefore()
            ->success('*.authToken = @')->endSuccess()
            ->error('*.errorMessage = "Přihlášení se nezdařilo. Zkontrolujte přihlašovací údaje."')->endError()
            ->after('*.preloader = false')->endAfter();
    }

}