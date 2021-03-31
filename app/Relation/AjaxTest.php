<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 30.03.2021
 * Time: 16:38
 */

namespace App\Meta;


class AjaxTest extends Meta
{
    const TEMPLATE = 'ajaxTest';
    protected $data;
    protected $method;
    protected $url;
    protected $result;
    protected $headers;

    /**
     * AjaxText constructor.
     * @param $data
     * @param $result
     * @param null $headers
     */
    public function __construct($filename, $method, $url, $data, $result, $headers)
    {
        parent::__construct($filename);
        $this->method = $method;
        $this->url = API_URL . $url;
        $this->data = $data;
        $this->result = $result;
        $this->headers = $headers;
    }
}