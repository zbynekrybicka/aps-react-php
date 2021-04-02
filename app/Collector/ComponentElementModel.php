<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:30
 */

namespace App\Collector;

/**
 * Class ComponentElementModel
 * @package App\Collector
 */
class ComponentElementModel extends Collector
{

    public function expression($expression) {
        $getter = self::$element->model;
        $setter = 'set' . ucfirst(self::$element->model);

        self::$element->attributes['defaultValue'] = $getter;
        self::$element->attributes['onChange'] = "e => dispatch($setter(e.target.value))";
        self::$components[self::$element->component]->selector($getter);
        self::$components[self::$element->component]->slice('select' . ucfirst($getter));
        self::$components[self::$element->component]->slice($setter);
        self::$slice->selector($getter, $expression);
        self::$slice->reducer($setter, ["$expression = action.payload"]);
        self::$slice->state($expression, "");
        return new ComponentElement;
    }

}