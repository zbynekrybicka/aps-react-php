<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:03
 */

namespace App\Collector;

/**
 * Class Ajax
 * @package App\Collector
 */
class Ajax extends Collector
{
    public function insertElement()
    {
        (new ComponentElement)->insertElement();
        return new Component(self::$element->component);
    }

    public function get()
    {
        self::$ajax = (object) ['method' => 'get'];
        return new AjaxUrl;
    }

    public function post()
    {
        self::$ajax = (object) ['method' => 'post'];
        return new AjaxUrl;
    }

    public function put()
    {
        self::$ajax = (object) ['method' => 'put'];
        return new AjaxUrl;
    }

    public function delete()
    {
        self::$ajax = (object) ['method' => 'delete'];
        return new AjaxUrl;
    }
}