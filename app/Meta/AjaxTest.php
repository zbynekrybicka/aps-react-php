<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 19:20
 */

namespace App\Meta;


class AjaxTest extends Meta
{
    const TEMPLATE = 'ajaxTest';

    protected $method;
    protected $url;
    protected $data;
    protected $result;
    protected $headers;

    public function __construct($filename, $method, $url, $data, $result, $headers)
    {
        parent::__construct($filename);
        $this->method = $method;
        $this->url = $url;
        $this->data = $data;
        $this->result = $result;
        $this->headers = $headers;
    }
}