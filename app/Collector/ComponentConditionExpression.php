<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 22:58
 */

namespace App\Collector;

/**
 * Class ComponentConditionExpression
 * @package App\Collector
 */
class ComponentConditionExpression extends Collector
{


    public function expression($expression): Component
    {
        self::$documentation->component(self::$componentCondition->component, self::$componentCondition->title, $expression);
        $title = self::$componentCondition->title;
        $component = self::$componentCondition->component;
        $selector = self::$componentCondition->selector;
        self::$components[$title]->content("{{$selector} && <$component />}");
        self::$components[$title]->selector($selector);
        self::$components[$title]->slice('select' . ucfirst($selector));
        self::$components[$title]->subComponent($component);
        self::$slice->selector(ucfirst($selector), $expression);
        preg_match_all('/\*\.(\S+)/', $expression, $result);
        foreach ($result[1] as $state) {
            self::$slice->state($state, false);
        }
        return new Component(self::$componentCondition->component);
    }
}