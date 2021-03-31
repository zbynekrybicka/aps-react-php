<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:05
 */

namespace App\Process;
use App\Relation\Component;

interface Process
{

    public static function execute(Component $component = null);

}