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

class Ajax
{

    /** @var Store $store */
    private $store;

    /** @var Slice[] */
    private $slice;

    /** @var string $ajax */
    private $ajax;

    /** @var Api $api */
    public static $api;

    /** @var AjaxTest[] $integration */
    public static $integration = [];

    /**
     * Ajax constructor.
     * @param Slice $slice
     * @param string $ajax
     */
    public function __construct(AjaxReturnable $element, $slice, $ajax)
    {
        $this->slice = $slice;
        $this->ajax = $ajax;
        $this->element = $element;
    }


    public function request($method, $url, $headers, $resource, $classMethod): Ajax
    {
        $title = $this->ajax;
        $this->slice->ajax($title, $method, $this->frontUrl($url), $headers,
            $title . 'Before',
            $title . 'After',
            $title . 'Success',
            $title . 'Error'
        );
        $name = $resource;
        $object = ucfirst($resource);
        static::$api->resource($name, $object);
        static::$api->request($method, $url, $name, $classMethod);
        return $this;
    }

    public function setBeforeAfterAsPreloader(): Ajax
    {
        $this->slice->reducer($this->ajax . 'Before', ['*.preloader = true']);
        $this->slice->reducer($this->ajax . 'After', ['*.preloader = false']);
        return $this;
    }


    public function success(array $lines): Ajax
    {
        $this->slice->reducer($this->ajax . 'Success', $lines);
        return $this;
    }

    public function insertAjax(): AjaxReturnable
    {
        return $this->element;
    }

    private function frontUrl($url)
    {
        $url = preg_replace('/\{\w+:(\w+)\}/', '$1', $url);
        return API_URL . preg_replace('/{.*}/', "' + param + '", $url);
    }

    public function authRequest($method, $url, $authToken, $resource, $classMethod)
    {
        return $this->request($method, $url, "{ headers: { Authorization: $authToken } }", $resource, $classMethod);
    }

    public function error($reducer): Ajax
    {
        $this->slice->reducer($this->ajax . 'Error', $reducer);
        return $this;
    }

    public function invisibleBeforeAndAfter(): Ajax
    {
        $this->slice->reducer($this->ajax . 'Before', []);
        $this->slice->reducer($this->ajax . 'After', []);
        return $this;
    }

    public function before($lines): Ajax
    {
        $this->slice->reducer($this->ajax . 'Before', $lines);
        return $this;
    }

    public function after($lines): Ajax
    {
        $this->slice->reducer($this->ajax . 'After', $lines);
        return $this;
    }

    public function noError(): Ajax
    {
        $this->slice->reducer($this->ajax . 'Error', []);
        return $this;
    }

    public function errorMessage(): Ajax
    {
        $this->slice->reducer( $this->ajax . 'Error', [ '*.errorMessage = action.payload.response.data' ]);
        return $this;
    }

    /*public function test($title, $method, $url, $data, $result, $headers = null): AjaxTest
    {
        static::$integration[] = new AjaxTest(__DIR__ . '/../../dist/api/tests/' . $title . 'spec.php', $method, $url, $data, $result, $headers);

    }*/


}