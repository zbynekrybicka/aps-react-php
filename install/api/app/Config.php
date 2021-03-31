<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 26.03.2021
 * Time: 23:06
 */

namespace App;


class Config
{

    /**
     * Config constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $data = json_decode(file_get_contents($filename));
        $this->data = $this->is_prod() ? $data->prod : $data->dev;
    }

    private function is_prod()
    {
        return strpos($_SERVER['SERVER_NAME'], 'localhost') === false && $_SERVER['SERVER_NAME'] !== '127.0.0.1';
    }

    public function __get(string $attr)
    {
        return $this->data->{$attr};
    }
}