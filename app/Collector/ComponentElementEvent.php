<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 23:33
 */

namespace App\Collector;

/**
 * Class ComponentElementEvent
 * @package App\Collector
 */
class ComponentElementEvent extends Collector
{
    public function ajax($ajax)
    {
        self::$element->ajax = $ajax;
        return new ComponentElementAjax;
    }

    public function reducer($reducer)
    {
        self::$element->reducer = $reducer;
        self::$element->reducerLines = [];
        return new ComponentElementReducer;
    }
}