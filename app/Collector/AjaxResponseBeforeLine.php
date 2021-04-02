<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:08
 */

namespace App\Collector;

/**
 * Class AjaxResponseBeforeLine
 * @package App\Collector
 */
class AjaxResponseBeforeLine extends Collector
{
    public function line($line)
    {
        self::$ajax->before[] = $line;
        return new AjaxResponseBeforeLine;
    }

    public function success()
    {
        self::$ajax->beforeReducer = 'before' . ucfirst(self::$element->ajax);
        self::$slice->reducer('before' . ucfirst(self::$element->ajax), self::$ajax->before);
        return new AjaxResponseSuccess;
    }
}