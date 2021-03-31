<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:45
 */

namespace App\Relation;


interface IAjaxResponseBefore
{

    public function beforePreloader(): IAjaxResponseSuccess;
    public function before(string $string): IAjaxResponseBefore;
    public function endBefore(): IAjaxResponseSuccess;
}