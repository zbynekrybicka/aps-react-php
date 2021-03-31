<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:33
 */

namespace App\Relation;


interface IElementSelector
{

    public function expression($string): IElement;
}