<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:04
 */

namespace App\Collector;

/**
 * Class AjaxUrl
 * @package App\Collector
 */
class AjaxUrl extends Collector
{

    public function url($url)
    {
        self::$ajax->url = $url;
        return new AjaxAuth;
    }

}