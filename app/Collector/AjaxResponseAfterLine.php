<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:14
 */

namespace App\Collector;

/**
 * Class AjaxResponseAfterLine
 * @package App\Collector
 */
class AjaxResponseAfterLine extends Collector
{
    public function insertElement()
    {
        $this->saveAjax();
        self::$element->afterReducer = 'after' . ucfirst(self::$element->ajax);
        self::$slice->reducer('after' . ucfirst(self::$element->ajax), self::$ajax->after);
        (new ComponentElement)->insertElement();
        return new Component(self::$element->component);
    }

    public function line($line)
    {
        self::$ajax->after[] = $line;
        return new AjaxResponseAfterLine;
    }

}