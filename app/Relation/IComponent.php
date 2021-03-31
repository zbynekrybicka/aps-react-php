<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:10
 */

namespace App\Relation;


interface IComponent
{

    public function component(string $string): IComponent;
    public function condition(string $string): IComponentCondition;

    public function element(string $string): IElement;

//    public function cycle(string $string): IComponentCycle;
//    public function element(string $string): IElement;

    public function test(string $identifier, string $before = ''): ITest;
    public function constant(string $path, string $value): IComponent;

}