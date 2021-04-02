<?php

namespace App\Process;

use App\Collector\Component;

class LoginForm implements IProcess
{

    public static function execute(Component $loginForm = null)
    {
        if (!$loginForm) {
            throw new ComponentNotFoundException(__CLASS__);
        }
        $loginForm->element('input')
            ->className('loginFormUsername')
            ->model('loginFormUsername')->expression('*.loginForm.username')
            ->param('type')->value('text')
            ->insertElement();

        $loginForm->element('input')
            ->className('loginFormPassword')
            ->model('loginFormPassword')->expression('*.loginForm.password')
            ->param('type')->value('password')
            ->insertElement();

        $loginForm->element('button')->className('loginFormSubmit')->event('click')
            ->ajax('postLogin')->selector('loginForm')->expression('*.loginForm')
            ->post()->url('/login')->noAuth()->service('user')->method('login')
            ->beforePreloader()->success()->line('*.authToken = @')->errorMessage()->afterPreloader()
            ->insertElement();

    }

}