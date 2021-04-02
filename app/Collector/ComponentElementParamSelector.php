<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 23:32
 */

namespace App\Collector;

/**
 * Class ComponentElementParamSelector
 * @package App\Collector
 */
class ComponentElementParamSelector extends Collector
{

    public function expression($expression)
    {
        self::$slice->selector(self::$element->selector, $expression);
        self::$components[self::$element->component]->slice('select' . ucfirst(self::$element->selector));
        self::$element->attributes[self::$element->param] = self::$element->selector;
        return new ComponentElement;
    }

}