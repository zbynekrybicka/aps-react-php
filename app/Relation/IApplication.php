<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:20
 */

namespace App\Relation;


interface IApplication extends IComponent
{

    public function export();

    public function test(string $identifier, string $before = '');

}