<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 6:00
 */

namespace App\Collector;


class AjaxResponseAfterPreloader extends Collector
{

    public function insertElement()
    {
        (new ComponentElement)->insertElement();
        return new Component(self::$element->component);
    }
}