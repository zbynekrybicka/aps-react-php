<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:14
 */

namespace App\Relation;


interface IComponentConditionPath
{
    public function expression(string $string): IComponent;
}