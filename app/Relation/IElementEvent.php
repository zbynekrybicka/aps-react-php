<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:32
 */

namespace App\Relation;


interface IElementEvent
{

    public function reducer($string): IElementReducer;

    public function ajax($string): IAjax;
}