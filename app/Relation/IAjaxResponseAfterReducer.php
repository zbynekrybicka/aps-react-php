<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 20:52
 */

namespace App\Relation;


interface IAjaxResponseAfterReducer
{

    public function after($string): IAjaxResponseAfterReducer;
    public function afterPreloader(): IElement;
    public function endAjax(): IElement;
}