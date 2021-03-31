<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 24.03.2021
 * Time: 19:28
 */

namespace App\Meta;


class Store extends Meta
{

    protected $reducers = [];
    const TEMPLATE = 'store';

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../dist/front/src/app/store.js');
    }

    public function reducer(string $reducer)
    {
        $this->reducers[] = $reducer;
    }

}