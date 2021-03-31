<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:40
 */

namespace App\Relation;


interface IAjaxAuthorization
{

    public function noAuth(): IAjaxService;
    public function auth(): IAjaxService;

}