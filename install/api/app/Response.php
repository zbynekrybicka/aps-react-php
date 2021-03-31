<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 26.03.2021
 * Time: 23:34
 */

namespace App;


class Response
{
    private $code;
    private $data;

    /**
     * Response constructor.
     * @param int $code
     * @param $data
     */
    public function __construct(int $code, $data)
    {
        $this->code = $code;
        $this->data = $data;
    }

    public function code()
    {
        return $this->code;
    }

    public function data()
    {
        return $this->data;
    }
}