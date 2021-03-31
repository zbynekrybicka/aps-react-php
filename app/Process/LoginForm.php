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
            ->event('change')->reducer('setLoginFormUsername')->line('*.loginForm.username = @')->end()
            ->param('defaultValue')->selector('loginFormUsername')->expression('*.loginForm.username');

        $loginForm->element('button')->className('loginFormSubmit')->event('click')
            ->ajax('postLogin')->selector('loginForm')->expression('*.loginForm')
            ->post()->url('/login')->noAuth()->service('user')->method('login')
            ->before('*.preloader = true')
            ->success('*.authToken = @')
            ->errorMessage('Přihlášení se nezdařilo. Zkontrolujte přihlašovací údaje.')
            ->after('*.preloader = false')->endAjax();
    }

}