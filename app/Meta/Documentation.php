<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 27.03.2021
 * Time: 18:11
 */

namespace App\Meta;


class Documentation extends Meta
{
    const TEMPLATE = 'documentation';

    protected $components = [];
    protected $parentComponent = 'App';
    protected $tests = [];

    public function component($title, $parent = '', $condition = '')
    {
        $this->components[] = (object) [
            'title' => $title,
            'parent' => $parent,
            'condition' => $condition
        ];
    }

    public function slice(Slice $slice)
    {
        $this->state = $slice->getInitialState();
        $this->reducers = $slice->getReducers();
    }

    public function e2e($identifier, $steps, ?E2ETest $before)
    {
        if ($before) {
            $this->tests[$identifier . ' < ' . $before->getId() ?? ''] = $steps;
        } else {
            $this->tests[$identifier] = $steps;
        }
    }


}