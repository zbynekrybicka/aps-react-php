<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:12
 */

namespace App\Collector;

/**
 * Class AjaxResponseError
 * @package App\Collector
 */
class AjaxResponseError extends Collector
{
    public function line($line)
    {
        self::$ajax->error[] = $line;
        return new AjaxResponseError;
    }

    public function after()
    {
        self::$slice->reducer('error' . ucfirst(self::$element->ajax), self::$ajax->error);
        return new AjaxResponseAfter;
    }


}