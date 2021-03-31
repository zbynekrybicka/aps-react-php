<?php

namespace App\Meta;


use App\Relation\Application;

class E2ETest extends Meta
{
    const TEMPLATE = 'cypress';

    protected $url;
    protected $before = null;
    protected $steps = [];
    protected $identifier;

    /** @var Documentation $documentation */
    private $documentation;

    public function __construct($filename, $identifier, $before, $url, $documentation)
    {
        parent::__construct($filename);
        $this->url = $url;
        $this->identifier = $identifier;
        if ($before) {
            $this->before = Application::$tests[$before];
        }
        $this->documentation = $documentation;
    }


    public function type(string $element, string $type): E2ETest
    {
        $this->steps[] = (object) [
            'step' => 'type',
            'element' => $element,
            'param' => $type
        ];
        $this->documentation->e2e($this->identifier, $this->steps, $this->before);
        return $this;
    }

    public function click(string $element): E2ETest
    {
        $this->steps[] = (object) [
            'step' => 'click',
            'element' => $element,
        ];
        $this->documentation->e2e($this->identifier, $this->steps, $this->before);
        return $this;
    }

    public function check(string $element, $count = 1): E2ETest
    {
        $this->steps[] = (object) [
            'step' => 'check',
            'element' => $element,
            'param' => $count
        ];
        $this->documentation->e2e($this->identifier, $this->steps, $this->before);
        return $this;
    }

    public function getSteps()
    {
        return $this->steps;
    }

    public function getBefore()
    {
        return $this->before;
    }

    public function getId()
    {
        return $this->identifier;
    }

    public function screenshot($filename)
    {
        $this->steps[] = (object) [
            'step' => 'screenshot',
            'element' => null,
            'param' => $filename . '.png'
        ];
        $this->documentation->e2e($this->identifier, $this->steps, $this->before);
        return $this;
    }

    public function checkNot($element)
    {
        $this->steps[] = (object) [
            'step' => 'checkNot',
            'element' => $element,
        ];
        $this->documentation->e2e($this->identifier, $this->steps, $this->before);
        return $this;
    }

}