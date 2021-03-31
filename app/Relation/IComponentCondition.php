<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:13
 */

namespace App\Relation;


interface IComponentCondition
{
    public function selector(string $string): IComponentConditionPath;
}