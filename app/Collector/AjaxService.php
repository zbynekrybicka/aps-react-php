<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:04
 */

namespace App\Collector;

/**
 * Class AjaxUrlService
 * @package App\Collector
 */
class AjaxService extends Collector
{
    public function service($service)
    {
        self::$ajax->service = $service;
        return new AjaxServiceMethod;
    }
}