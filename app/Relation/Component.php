<?php
namespace App\Relation;

use App\Meta\Component as MetaComponent;
use App\Meta\Documentation;
use App\Meta\Slice;
use App\Meta\E2ETest;

class Component implements
    IComponent,
    IElement,
    IElementParam,
    IElementSelector,
    IElementEvent,
    IElementReducer
{

    /** @var MetaComponent[] $components */
    public static $components = [];

    /** @var Slice $slice  */
    public static $slice;

    /** @var E2ETest[] $tests  */
    public static $tests = [];

    /** @var Documentation $documentation */
    public static $documentation;

    public static $api;

    private $title;



    public function constant(string $path, string $value): IComponent
    {
        Component::$slice->state($path, $value);
        return $this;
    }

    public function test(string $identifier, string $connectedOn = ''): ITest
    {
        $test = new E2ETest(__DIR__ . '/../../cypress/integration/' . $identifier . '.spec.js', $identifier, $connectedOn, FRONT_URL, Component::$documentation);
        Component::$tests[$identifier] = $test;
        return $test;
    }



    public function className(string $string): IElement
    {
        // TODO: Implement className() method.
    }

    public function param(string $string): IElementParam
    {
        // TODO: Implement param() method.
    }

    public function event($string): IElementEvent
    {
        // TODO: Implement event() method.
    }

    public function model($string): IElement
    {
        // TODO: Implement model() method.
    }

    public function component(string $string): IComponent
    {
        // TODO: Implement component() method.
    }

    public function condition(string $string): IComponentCondition
    {
        // TODO: Implement condition() method.
    }

    public function element(string $string): IElement
    {
        // TODO: Implement element() method.
    }

    public function value(string $string): IElement
    {
        // TODO: Implement value() method.
    }

    public function selector($string): IElementSelector
    {
        // TODO: Implement selector() method.
    }

    public function expression($string): IElement
    {
        // TODO: Implement expression() method.
    }

    public function reducer($string): IElementReducer
    {
        // TODO: Implement reducer() method.
    }

    public function ajax($string): IAjax
    {
        // TODO: Implement ajax() method.
    }

    public function line($string): IElementReducer
    {
        // TODO: Implement line() method.
    }

    public function end(): IElement
    {
        // TODO: Implement end() method.
    }
}