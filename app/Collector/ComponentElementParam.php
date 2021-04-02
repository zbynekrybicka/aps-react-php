<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 23:30
 */

namespace App\Collector;

/**
 * Class ComponentElementParam
 * @package App\Collector
 */
class ComponentElementParam extends Collector
{

    public function value($value): ComponentElement
    {
        self::$element->attributes[self::$element->param] = "'$value'";
        return new ComponentElement;
    }

    public function selector($selector)
    {
        self::$element->selector = $selector;
        return new ComponentElementParamSelector;
    }
}