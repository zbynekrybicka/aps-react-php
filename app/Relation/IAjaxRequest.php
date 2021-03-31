<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:38
 */

namespace App\Relation;


interface IAjaxRequest
{

    public function get(): IAjaxUrl;
    public function post(): IAjaxUrl;
    public function put(): IAjaxUrl;
    public function delete(): IAjaxUrl;
}