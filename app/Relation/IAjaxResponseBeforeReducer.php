<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:45
 */

namespace App\Relation;


interface IAjaxResponseBeforeReducer
{

    public function beforePreloader(): IAjaxResponseBeforeReducer;
    public function before(string $string): IAjaxResponseBeforeReducer;
    public function success(string $string): IAjaxResponseSuccess;
}