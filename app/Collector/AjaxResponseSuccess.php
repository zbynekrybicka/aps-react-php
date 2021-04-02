<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:07
 */

namespace App\Collector;

/**
 * Class AjaxResponseSuccess
 * @package App\Collector
 */
class AjaxResponseSuccess extends Collector
{

    public function line($line)
    {
        self::$ajax->success = [];
        self::$ajax->success[] = $line;
        return new AjaxResponseSuccessLine;
    }
}