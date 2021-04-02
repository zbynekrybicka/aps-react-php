<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:00
 */

namespace App\Collector;

/**
 * Class ComponentElementAjaxSelector
 * @package App\Collector
 */
class ComponentElementAjaxSelector extends Collector
{

    public function expression($expression)
    {
        $event = 'on' . ucfirst(self::$element->param);
        $ajax = self::$element->ajax;
        $selector = self::$element->ajaxSelector;
        self::$slice->selector('authorization', '*.authToken');
        self::$slice->selector($selector, $expression);

        self::$components[self::$element->component]->selector('authorization');
        self::$components[self::$element->component]->selector($selector);

        self::$components[self::$element->component]->slice('selectAuthorization');
        self::$components[self::$element->component]->slice('select' . ucfirst($selector));
        self::$components[self::$element->component]->slice($ajax);

        self::$element->attributes[$event] = "() => dispatch($ajax({ data: $selector, authorization }))";
        return new Ajax;
    }

}