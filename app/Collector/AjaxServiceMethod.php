<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:05
 */

namespace App\Collector;

/**
 * Class AjaxUrlMethod
 * @package App\Collector
 */
class AjaxServiceMethod extends Collector
{
    public function method($classMethod)
    {
        $method = self::$ajax->method;
        $url = self::$ajax->url;
        $service = self::$ajax->service;
        self::$api->resource($service, ucfirst($service));
        self::$api->request($method, $url, $service, $classMethod);
        return new AjaxResponseBefore;
    }
}