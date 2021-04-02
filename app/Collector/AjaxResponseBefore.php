<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:06
 */

namespace App\Collector;

/**
 * Class AjaxResponseBefore
 * @package App\Collector
 */
class AjaxResponseBefore extends Collector
{

    public function before()
    {
        self::$ajax->before = [];
        return new AjaxResponseBeforeLine;
    }

    public function noBefore()
    {
        self::$ajax->beforeReducer = 'noBefore';
        self::$slice->reducer('noBefore', []);
        return new AjaxResponseSuccess;
    }

    public function beforePreloader()
    {
        self::$ajax->beforeReducer = 'beforePreloader';
        self::$slice->reducer('beforePreloader', [ 'state.preloader = true' ]);
        self::$slice->state('preloader', false);
        return new AjaxResponseBeforePreloader;
    }

}