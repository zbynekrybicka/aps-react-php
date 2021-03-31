<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:35
 */

namespace App\Relation;


interface IAjax
{

    public function selector(string $string): IAjaxDataSelector;
}