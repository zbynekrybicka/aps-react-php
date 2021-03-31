<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:24
 */

namespace App\Process;


use Exception;

class ComponentNotFoundException extends Exception
{

    /**
     * ComponentNotFoundException constructor.
     * @param string $className
     */
    public function __construct($className)
    {
        $this->message = 'Object of ' . $className . ' not found.';
    }
}