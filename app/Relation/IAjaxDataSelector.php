<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:38
 */

namespace App\Relation;


interface IAjaxDataSelector
{

    public function expression($string): IAjaxRequest;
}