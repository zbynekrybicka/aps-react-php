<?php

namespace App\Meta;


class Api extends Meta
{
    const TEMPLATE = 'api';

    protected $resources;
    protected $requests;

    public function resource(string $variable, string $object)
    {
        $this->resources[$variable] = $object;
    }

    public function request(string $method, string $url, string $resource, string $classMethod)
    {
        $this->requests[] = (object) [
            'method' => $method,
            'url' => $url,
            'resource' => $resource,
            'classMethod' => $classMethod
        ];
    }
}