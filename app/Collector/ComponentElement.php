<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 23:28
 */

namespace App\Collector;

/**
 * Class ComponentElement
 * @package App\Collector
 */
class ComponentElement extends Collector
{

    public function param($param)
    {
        self::$element->param = $param;
        return new ComponentElementParam;
    }

    public function event($event)
    {
        self::$element->param = $event;
        return new ComponentElementEvent;
    }

    public function className($className): ComponentElement
    {
        self::$element->attributes['className'] = "'$className'";
        return $this;
    }

    public function model($selector)
    {
        self::$element->model = $selector;
        return new ComponentElementModel;
    }

    public function insertElement(): Component
    {
        $element = self::$element->title;
        $attributes = [];
        foreach (self::$element->attributes as $attribute => $value) {
            $attributes[] = $attribute . "={{$value}}";
        }
        self::$components[self::$element->component]->content("<{$element} " .
            implode( ' ', $attributes) .
            (self::$element->label ? ">" . self::$element->label ."</$element>": '/>'));
        return new Component(self::$element->component);
    }

    public function label($label): ComponentElement
    {
        self::$element->label = $label;
        return $this;
    }
}