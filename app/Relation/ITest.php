<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 21:06
 */

namespace App\Relation;


interface ITest
{

    public function click(string $element): ITest;
    public function type(string $element, string $text): ITest;
    public function check(string $element, int $count = 1): ITest;
    public function checkNot(string $element): ITest;
    public function screenshot(string $filename): ITest;

}