<?php

namespace App\Process;


use App\Collector\Component;

class Menu implements IProcess
{

    public static function execute(Component $menu = null)
    {
        $container = $menu->component('MenuContainer');
        $container->component('MenuHideButton')
            ->element('button')
            ->label('-')
            ->event('click')->reducer('toggleMenu')->line('*.menuHidden = !*.menuHidden')->end()
            ->insertElement();

        $container->condition('MenuContent')->selector('isMenuShown')->expression('!*.menuHidden')
            ->element('div')
            ->className('calendarLink')
            ->label('Kalendář')
            ->event('click')->reducer('setCalendarLink')->line('*.side = false')->end()
            ->insertElement()
        ;
    }
}