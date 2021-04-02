<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 22:54
 */

namespace App\Collector;
use App\Meta\Component as MetaComponent;
use App\Meta\E2ETest;

/**
 * Class Component
 * @package App\Collector
 * @method Component cycle($component)
 */
class Component extends Collector
{

    private $title;

    public function __construct($component)
    {
        $component = ucfirst($component);
        $this->title = $component;
        if (!array_key_exists($component, self::$components)) {
            self::$components[$component] = new MetaComponent(__DIR__ . '/../../dist/front/src/app/components/' . $component . '.js', $component);
        }
    }

    public function component($component): Component
    {
        $component = ucfirst($component);
        self::$components[$this->title]->content("<$component />");
        self::$components[$this->title]->subComponent($component);
        self::$documentation->component($component, $this->title);
        return new Component($component);
    }

    public function condition($component): ComponentConditionSelector
    {
        $component = ucfirst($component);
        self::$componentCondition = (object) [ 'component' => $component, 'title' => $this->title ];
        return new ComponentConditionSelector;
    }

    public function element($element): ComponentElement
    {
        self::$element = (object) [ 'component' => $this->title, 'title' => $element, 'attributes' => [], 'label' => '' ];
        return new ComponentElement;
    }

}