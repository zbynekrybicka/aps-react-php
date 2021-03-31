<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:41
 */

namespace App\Relation;


interface IAjaxService
{

    public function service($string): IAjaxMethod;
}