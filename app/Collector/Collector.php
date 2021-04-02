<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.03.2021
 * Time: 23:20
 */

namespace App\Collector;


use App\Meta\Api;
use App\Meta\Collector as MetaCollector;
use App\Meta\Component;
use App\Meta\Documentation;
use App\Meta\E2ETest;
use App\Meta\Slice;

abstract class Collector
{
    public static $steps = [];

    protected static $componentCondition;
    protected static $element;
    protected static $ajax;
    protected static $test;


    /** @var Component[]  */
    public static $components = [];

    /** @var Slice */
    public static $slice;

    /** @var Api */
    public static $api;

    /** @var E2ETest[] */
    public static $tests;

    /** @var Documentation */
    public static $documentation;

    private static function generateDocumentation()
    {
        self::$documentation->slice(self::$slice);
        self::$documentation->export();
        $data = [];
        foreach (glob(__DIR__ . "/*.php") as $file) {
            $source = file_get_contents($file);
            preg_match_all('/public\s+function\s+([a-zA-Z0-9]+)\(.*return\s+\(?new\s+(.+)[\(\);]/Us', $source, $result);
            $className = preg_replace('/.*\/(.*)\.php/U', '$1', $file);
            if ($className !== 'Collector') {
                $data[$className] = array_combine($result[1], $result[2]);
            }
        }
        $collector = new MetaCollector(__DIR__ . '/../../documentation/collector.html', $data, 'Application');
        $collector->export();
    }


    public function __call($name, $arguments)
    {
        self::$steps[] = [$name, $arguments[0] ?? null];
        return $this;
    }

    public static function export()
    {
        self::$api->export();
        foreach (self::$components as $component) {
            $component->export();
        }
        foreach (self::$tests as $test) {
            $test->export();
        }
        self::generateDocumentation();
        self::$slice->export();
    }

    protected function saveAjax()
    {
        self::$slice->ajax(
            self::$element->ajax,
            self::$ajax->method,
            self::$ajax->url,
            self::$ajax->headers,
            self::$ajax->beforeReducer,
            self::$element->afterReducer,
            self::$element->successReducer,
            self::$element->errorReducer
        );
    }


}