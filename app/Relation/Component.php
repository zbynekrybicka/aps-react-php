<?php
namespace App\Relation;

use App\Meta\Component as MetaComponent;
use App\Meta\Documentation;
use App\Meta\Slice;
use App\Meta\E2ETest;

class Component implements AjaxReturnable
{

    /** @var MetaComponent[] $components */
    protected static $components = [];

    /** @var Slice $slice  */
    protected static $slice;

    /** @var E2ETest[] $tests  */
    public static $tests = [];

    /** @var MetaComponent $metaComponent */
    protected $metaComponent;

    /** @var MetaComponent $metaComponent */
    private static $paramMetaComponent;

    /** @var Documentation $documentation */
    protected static $documentation;

    private $title;



    public function __construct($title) {
        $component = new MetaComponent(__DIR__ . '/../../dist/front/src/app/components/' . ucfirst($title) . '.js', $title);
        static::$components[] = $component;
        self::$paramMetaComponent = $component;
        $this->metaComponent = $component;
        $this->title = $title;
    }

    public function subComponent(string $title, $begin = '', $end = ''): Component
    {
        static::$documentation->component($title, $this->title);
        $this->metaComponent->subComponent($title);
        $this->metaComponent->content($begin . '<' . ucfirst($title) . ' />' . $end);
        return new Component($title);
    }

    public function subComponentWithParams(string $title, $begin = '', $end = ''): ComponentElement
    {
        static::$documentation->component($title, $this->title);
        $this->metaComponent->subComponent($title);
        return new ComponentElement($this, new Component($title), static::$slice, $title, $begin, $end);
    }

    public function element(string $title, $begin = '', $end = ''): ComponentElement
    {
        return new ComponentElement($this, $this, static::$slice, $title, $begin, $end);
    }

    public function elementWithLabel(string $title, string $label, $begin = '', $end = ''): ComponentElement
    {
        return new ComponentElement($this, $this, static::$slice, $title, $begin, $end, $label);
    }

    public function elementWithState($title, $variable, $state, $begin = '', $end = '')
    {
        $this->metaComponent->slice('select' . ucfirst($variable));
        $this->metaComponent->selector($variable);
        static::$slice->selector($variable, $state);
        static::$slice->state($state, '');
        return new ComponentElement($this, $this, static::$slice, $title, $begin, $end, "{{$variable}}");
    }

    public function condition($subComponent, $variable, $state): Component
    {
        static::$documentation->component($subComponent, $this->title, $state);
        $this->metaComponent->slice('select' . ucfirst($variable));
        $this->metaComponent->selector($variable);
        static::$slice->selector($variable, $state);
        static::$slice->state($state, false);
        return $this->subComponent($subComponent, '{' . $variable . ' && ', '}');
    }


    public function getMeta()
    {
        return $this->metaComponent;
    }

    public function inputElement(string $type, string $placeholder, string $variable, string $path): Component
    {
        return $this->element('input')
            ->paramValue('type', $type)
            ->paramValue('placeholder', $placeholder)
            ->paramValue('name', $variable)
            ->paramState('defaultValue', $variable, $path)
            ->paramEventReducer('change', 'set' . ucfirst($variable), [ $path . ' = action.payload' ])
            ->insertElement();
    }

    public function initAjax($ajax, $param = '', $state = '')
    {
        $this->metaComponent->initAjax($ajax, $param);
        $this->metaComponent->slice($ajax);
        if ($param) {
            $this->metaComponent->slice('select' . ucfirst($param));
            $this->metaComponent->selector($param);
            static::$slice->selector($param, $state);
        }
        return new Ajax($this, static::$slice, $ajax);
    }


    public function insertElement(): Component
    {
        return $this;
    }

    public function cycleComponent(string $subComponent, string $variable, string $path): Component
    {
        static::$documentation->component($subComponent, $this->title, "FOR: $path");
        $this->metaComponent->slice('select' . ucfirst($variable));
        $this->metaComponent->selector($variable);
        static::$slice->selector($variable, $path);
        static::$slice->state($path, false);
        $this->metaComponent->subComponent($subComponent);
        $this->metaComponent->content('{' . $variable . '.map((item, key) => <' . ucfirst($subComponent) . ' item={item} key={key} />)}');
        return new Component($subComponent);
    }
}