<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 10:58
 */

namespace App\Collector;

/**
 * Class ComponentElementAjax
 * @package App\Collector
 */
class ComponentElementAjax extends Collector
{
    public function noData()
    {
        $event = 'on' . ucfirst(self::$element->param);
        $ajax = self::$element->ajax;
        self::$slice->selector('authorization', '*.authToken');
        self::$components[self::$element->component]->selector('authorization');
        self::$components[self::$element->component]->slice('selectAuthorization');
        self::$element->attributes[$event] = "() => $ajax({ data: null, authorization })";
        return new Ajax;
    }

    public function selector($selector)
    {
        self::$element->ajaxSelector = $selector;
        return new ComponentElementAjaxSelector;
    }
}