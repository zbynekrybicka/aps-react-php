<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:13
 */

namespace App\Collector;

/**
 * Class AjaxResponseAfter
 * @package App\Collector
 */
class AjaxResponseAfter extends Collector
{
    public function line($line)
    {
        self::$ajax->after[] = $line;
        return new AjaxResponseAfterLine;
    }

    public function noAfter()
    {
        self::$element->afterReducer = 'noAfter';
        self::$slice->reducer('noAfter', []);
        $this->saveAjax();
        return new ComponentElement;
    }


}