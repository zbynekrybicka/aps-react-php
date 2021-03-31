<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:43
 */

namespace App\Relation;


interface IAjaxResponseSuccess
{

    public function success(string $string): IAjaxResponseSuccess;
    public function endSuccess(): IAjaxResponseError;
}