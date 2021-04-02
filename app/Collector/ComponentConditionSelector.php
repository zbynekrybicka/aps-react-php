<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 22:57
 */

namespace App\Collector;

/**
 * Class ComponentConditionSelector
 * @package App\Collector
 */
class ComponentConditionSelector extends Collector
{


    public function selector($selector): ComponentConditionExpression
    {
        self::$componentCondition->selector = $selector;
        return new ComponentConditionExpression;
    }

}