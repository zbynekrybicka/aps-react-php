<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:24
 */

namespace App\Collector;

/**
 * Class AjaxAuth
 * @package App\Collector
 */
class AjaxAuth extends Collector
{

    public function auth()
    {
        if (in_array(self::$ajax->method, ['post', 'put'])) {
            self::$ajax->headers = '{ Authorization: param.authorization }';
        } else {
            self::$ajax->headers = '{ Authorization: param.authorization, params: param.data }';
        }
        return new AjaxService;
    }

    public function noAuth()
    {
        if (in_array(self::$ajax->method, ['post', 'put'])) {
            self::$ajax->headers = '{}';
        } else {
            self::$ajax->headers = '{ params: param.data }';
        }
        return new AjaxService;
    }

}