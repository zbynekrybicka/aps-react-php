<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 26.03.2021
 * Time: 22:57
 */

namespace App;


use Firebase\JWT\BeforeValidException;
use Firebase\JWT\JWT;

class Request
{

    protected $headers;
    protected $vars;
    protected $data;

    /**
     * PostRequest constructor.
     * @param $vars
     * @param $headers
     * @param mixed $data
     */
    public function __construct($vars, $headers, $data = [])
    {
        $this->vars = $vars;
        $this->headers = $headers;
        $this->data = $data;

    }

    public function getUser(): ?object
    {
        if (array_key_exists('Authorization', $this->headers) || array_key_exists('authorization', $this->headers)) {
            $config = new Config(__DIR__ . '/../config.json');
            try {
                return JWT::decode($this->headers['Authorization'] ?? $this->headers['authorization'], $config->jwt, ['HS256']);
            } catch (BeforeValidException $ex) {
                return null;
            }
        } else {
            return null;
        }
    }

    public function variable(string $index)
    {
        return $this->vars[$index];
    }

    public function value(string $index) {
        return $this->data[$index];
    }

    public function field(array $indexes) {
        $data = $this->data;
        $result = [];
        foreach ($indexes as $index) {
            $result[$index] = $data[$index];
        }
        return $result;
    }

    public function data()
    {
        return $this->data;
    }

}