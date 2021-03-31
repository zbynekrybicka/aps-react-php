<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 27.03.2021
 * Time: 6:02
 */

namespace App\Relation;


use App\Meta\Slice;

class ComponentElement implements AjaxReturnable
{
    private $params;
    private $label;
    private $component;
    private $begin;
    private $title;
    private $end;
    private $return;
    private $slice;

    /**
     * ComponentElement constructor.
     * @param string $title
     * @param string $begin
     * @param string $end
     */
    public function __construct(Component $component, Component $return, Slice $slice, $title, $begin, $end, $label = '')
    {
        $this->title = $title;
        $this->begin = $begin;
        $this->end = $end;
        $this->label = $label;
        $this->component = $component;
        $this->return = $return;
        $this->params = [];
        $this->slice = $slice;
    }

    public function insertElement(): Component
    {
        $result = '';
        foreach ($this->params as $key => $value) {
            $result .= ' ' . $key . "={{$value}}";
        }
        if ($this->label) {
            $this->component->getMeta()->content($this->begin . '<' . lcfirst($this->title) . $result . '>' . $this->label . '</' . lcfirst($this->title) . '>' . $this->end);
        } else {
            $this->component->getMeta()->content($this->begin . '<' . lcfirst($this->title) . $result . ' />' . $this->end);
        }
        return $this->return;
    }

    public function insertComponent(): Component
    {
        return $this->insertElement();
    }

    public function paramValue(string $attribute, string $value): ComponentElement
    {
        $this->params[$attribute] = "'" . $value . "'";
        return $this;
    }

    public function paramState(string $attribute, string $value, string $expression): ComponentElement
    {
        $this->component->getMeta()->slice('select' . ucfirst($value));
        $this->component->getMeta()->selector($value);
        $this->slice->selector($value, $expression);
        $this->slice->state($expression, '');
        $this->params[$attribute] = $value;
        return $this;
    }

    public function paramEventReducer(string $event, string $reducer, array $lines = [], string $param = 'e.target.value'): ComponentElement
    {
        $this->component->getMeta()->slice($reducer);
        if ($lines) {
            $this->slice->reducer($reducer, $lines);
        }
        $this->params['on' . ucfirst($event)] = "e => dispatch($reducer($param))";
        return $this;
    }

    public function paramEventAjax(string $event, string $ajax, string $param = '', string $state = ''): Ajax
    {
        $event = 'on' . ucfirst($event);
        $this->component->getMeta()->slice($ajax);
        if ($param) {
            if ($state) {
                $this->component->getMeta()->slice('select' . ucfirst($param));
                $this->component->getMeta()->selector($param);
                $this->slice->selector($param, $state);
            }
            $this->params[$event] = "e => dispatch($ajax($param))";
        } else {
            $this->params[$event] = " e => dispatch($ajax())";
        }
        return new Ajax($this, $this->slice, $ajax, $param);
    }

    public function paramClass($string)
    {
        return $this->paramValue('className', $string);
    }

    public function paramProps($attribute, $propValue)
    {
        $this->params[$attribute] = "props." . $propValue;
        return $this;
    }

    public function className($className): ComponentElement
    {
        return $this->paramValue('className', $className);
    }



}