<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 5:21
 */

namespace App\Collector;

/**
 * Class AjaxResponseBeforePreloader
 * @package App\Collector
 */
class AjaxResponseBeforePreloader extends Collector
{

    public function success()
    {
        return new AjaxResponseSuccess;
    }
}