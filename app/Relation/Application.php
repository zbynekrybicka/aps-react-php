<?php

namespace App\Relation;

use App\Meta\Api;
use App\Meta\Documentation;
use App\Meta\E2ETest;
use App\Meta\Slice;

class Application
{

    public function __construct()
    {
        Component::$components = [];
        Component::$slice = new Slice(__DIR__ . '/../../dist/front/src/app/appSlice.js', 'app');
        Component::$tests = [];
        Component::$documentation = new Documentation(__DIR__ . '/../../documentation.html');
        Component::$api = new Api(__DIR__ . '/../../dist/api/index.php');
    }


    public function export()
    {
        foreach (Component::$components as $component) {
            $component->export();
        }

        foreach (Component::$tests as $test) {
            $test->export();
        }

        foreach (Ajax::$integration as $test) {
            $test->export();
        }

        Component::$documentation->slice(Component::$slice);
        Component::$documentation->export();
        Component::$slice->export();
        Component::$api->export();
    }

    public function content(): IComponent
    {
        Component::$documentation->component('app');
        $component = new Component('app');
        Component::$components = $component;
        return $component;
    }

}