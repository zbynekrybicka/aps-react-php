<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:26
 */

namespace App\Relation;


interface IElement
{

    public function className(string $string): IElement;

    public function param(string $string): IElementParam;

    public function event($string): IElementEvent;

    public function model($string): IElement;
}