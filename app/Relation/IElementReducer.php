<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:33
 */

namespace App\Relation;


interface IElementReducer
{

    public function line($string): IElementReducer;

    public function end(): IElement;
}