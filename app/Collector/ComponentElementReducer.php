<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 10:57
 */

namespace App\Collector;

/**
 * Class ComponentElementReducer
 * @package App\Collector
 */
class ComponentElementReducer extends Collector
{

    public function line($line)
    {
        self::$element->reducerLines[] = $line;
        return new ComponentElementReducer;
    }

    public function end()
    {
        self::$element->attributes['on'. ucfirst(self::$element->param)] = '() => dispatch(' . self::$element->reducer . '())';
        self::$slice->reducer(self::$element->reducer, self::$element->reducerLines);
        self::$components[self::$element->component]->slice(self::$element->reducer);
        return new ComponentElement;
    }

}