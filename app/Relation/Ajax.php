<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 24.03.2021
 * Time: 20:46
 */

namespace App\Relation;


use App\Meta\AjaxTest;
use App\Meta\Api;
use App\Meta\Slice;
use App\Meta\Store;
use App\Meta\Component as MetaComponent;

class Ajax implements
    IAjax,
    IAjaxDataSelector,
    IAjaxRequest,
    IAjaxUrl,
    IAjaxAuthorization,
    IAjaxService,
    IAjaxMethod,
    IAjaxResponseBefore,
    IAjaxResponseSuccess
{


    public function selector(string $string): IAjaxDataSelector
    {
        // TODO: Implement selector() method.
    }

    public function expression(string $string): IAjaxRequest
    {
        // TODO: Implement expression() method.
    }

    public function get(): IAjaxUrl
    {
        // TODO: Implement get() method.
    }

    public function post(): IAjaxUrl
    {
        // TODO: Implement post() method.
    }

    public function put(): IAjaxUrl
    {
        // TODO: Implement put() method.
    }

    public function delete(): IAjaxUrl
    {
        // TODO: Implement delete() method.
    }

    public function url(string $string): IAjaxAuthorization
    {
        // TODO: Implement url() method.
    }

    public function noAuth(): IAjaxService
    {
        // TODO: Implement noAuth() method.
    }

    public function auth(): IAjaxService
    {
        // TODO: Implement auth() method.
    }

    public function service(string $string): IAjaxMethod
    {
        // TODO: Implement service() method.
    }

    public function method(string $string): IAjaxResponseBefore
    {
        // TODO: Implement method() method.
    }

    public function beforePreloader(): IAjaxResponseSuccess
    {
        // TODO: Implement beforePreloader() method.
    }

    public function before(string $string): IAjaxResponseBefore
    {
        // TODO: Implement before() method.
    }

    public function success(string $string): IAjaxResponseSuccess
    {
        // TODO: Implement success() method.
    }

    public function error(string $string): IAjaxResponseError
    {
        // TODO: Implement error() method.
    }

    public function errorMessage(string $string): IAjaxResponseAfter
    {
        // TODO: Implement errorMessage() method.
    }

    public function endBefore(): IAjaxResponseSuccess
    {
        // TODO: Implement endBefore() method.
    }

    public function endSuccess(): IAjaxResponseError
    {
        // TODO: Implement endSuccess() method.
    }
}