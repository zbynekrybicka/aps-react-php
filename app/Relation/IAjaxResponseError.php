<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:51
 */

namespace App\Relation;


interface IAjaxResponseError
{

    public function error($string): IAjaxResponseError;
    public function endError(): IAjaxResponseAfter;
}