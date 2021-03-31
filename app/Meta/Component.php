<?php

namespace App\Meta;


class Component extends Meta
{

    const TEMPLATE = 'component';

    protected $initAjax = null;
    protected $title = '';
    protected $subComponents = [];
    protected $content = [];
    protected $slices = [];
    protected $selectors = [];

    public function __construct($filename, $title)
    {
        parent::__construct($filename);
        $this->title = $title;
    }

    public function subComponent(string $subComponent)
    {
        $this->subComponents[lcfirst($subComponent)] = lcfirst($subComponent);
    }

    public function content($element)
    {
        $this->content[] = $element;
    }

    public function slice($slice)
    {
        $this->slices[$slice] = $slice;
    }

    public function selector($selector)
    {
        $this->selectors[$selector] = $selector;
    }

    public function initAjax($ajax, $param)
    {
        $this->initAjax = $ajax . '(' . $param . ')';
    }

}