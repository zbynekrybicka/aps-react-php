<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.04.2021
 * Time: 11:11
 */

namespace App\Collector;

/**
 * Class AjaxResponseSuccessLine
 * @package App\Collector
 */
class AjaxResponseSuccessLine extends Collector
{
    public function line($line)
    {
        self::$ajax->success[] = $line;
        return new AjaxResponseSuccessLine;
    }

    public function error()
    {
        $this->saveSuccess();
        self::$ajax->error = [];
        return new AjaxResponseError;
    }

    public function noError()
    {
        $this->saveSuccess();
        self::$slice->reducer('noError', []);
        return new AjaxResponseAfter;
    }

    public function errorMessage()
    {
        $this->saveSuccess();
        self::$element->errorReducer = 'errorMessage';
        self::$slice->reducer('errorMessage', [ '*.errorMessage = *.errorMessages[@]' ]);
        self::$slice->state('*.errorMessage', '');
        return new AjaxResponseAfterInit;
    }

    private function saveSuccess()
    {
        self::$element->successReducer = 'success' . ucfirst(self::$element->ajax);
        self::$slice->reducer('success' . ucfirst(self::$element->ajax), self::$ajax->success);
    }
}