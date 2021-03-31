<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:31
 */

namespace App\Relation;


interface IElementParam
{

    public function value(string $string): IElement;

    public function selector($string): IElementSelector;
}