<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:52
 */

namespace App\Relation;


interface IAjaxResponseAfter
{

    public function after($string): IAjaxResponseAfter;
    public function afterPreloader(): IElement;
    public function endAfter(): IElement;
}