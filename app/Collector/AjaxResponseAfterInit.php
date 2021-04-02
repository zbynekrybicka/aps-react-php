<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 5:52
 */

namespace App\Collector;


class AjaxResponseAfterInit extends Collector
{

    public function after()
    {
        self::$ajax->after = [];
        return new AjaxResponseAfter;
    }

    public function afterPreloader()
    {
        self::$element->afterReducer = 'afterPreloader';
        self::$slice->reducer('afterPreloader', [ '*.preloader = false' ]);
        $this->saveAjax();
        return new AjaxResponseAfterPreloader;
    }

}