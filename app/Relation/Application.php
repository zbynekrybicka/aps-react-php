<?php

namespace App\Relation;

use App\Meta\Api;
use App\Meta\Documentation;
use App\Meta\E2ETest;
use App\Meta\Slice;

class Application extends Component implements IApplication
{

    public static function create(): IApplication
    {
        return new self();
    }


    public function __construct()
    {
        static::$components = [];
        static::$slice = new Slice(__DIR__ . '/../../dist/front/src/app/appSlice.js', 'app');
        static::$tests = [];
        static::$documentation = new Documentation(__DIR__ . '/../../documentation.html');
        static::$documentation->component('app');
        Ajax::$api = new Api(__DIR__ . '/../../dist/api/index.php');
        parent::__construct('app');
    }


    public function export()
    {
        foreach (static::$components as $component) {
            $component->export();
        }

        foreach (static::$tests as $test) {
            $test->export();
        }

        foreach (Ajax::$integration as $test) {
            $test->export();
        }

        static::$documentation->slice(static::$slice);
        static::$documentation->export();
        static::$slice->export();
        Ajax::$api->export();
    }

    public function test(string $identifier, $connectedOn = null)
    {
        $test = new E2ETest(__DIR__ . '/../../cypress/integration/' . $identifier . '.spec.js', $identifier, $connectedOn, FRONT_URL, static::$documentation);
        static::$tests[$identifier] = $test;
        return $test;
    }

    public function constant(string $path, $value): Application
    {
        static::$slice->state($path, $value);
        return $this;
    }

}