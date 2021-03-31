<?php

namespace App\Meta;


use Adbar\Dot;

class Slice extends Meta
{
    const TEMPLATE = 'slice';
    protected $name;
    protected $initialState;
    protected $reducers = [];
    protected $ajax = [];
    protected $selectors = [];
    protected $importedStores = [];

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';

    public function __construct($filename, $name)
    {
        parent::__construct($filename);
        $this->name = $name;
        $this->initialState = new Dot([]);
    }

    public function state(string $path, $value)
    {
        list($path) = explode(" ", $path);
        $this->initialState->add(str_replace('*.', '', $path), $value);
    }

    public function export(): void
    {
        $this->initialState = $this->getInitialState();
        parent::export();
    }

    public function reducer(string $title, array $lines)
    {
        $this->reducers[$title] = $lines;
    }

    public function selector(string $selector, string $expression)
    {
        $this->selectors[$selector] = $expression;
    }

    public function ajax(string $title, string $method, string $url, string $headers, string $before, string $after, string $success, string $error)
    {
        $this->ajax[$title] = (object) [
            'method' => $method,
            'url' => $url,
            'headers' => $headers,
            'before' => $before,
            'after' => $after,
            'success' => $success,
            'error' => $error
        ];
    }

    public function importReducer(string $store, string $reducer)
    {
        $this->initImportReducer($store);
        $this->importedStores[$store]['reducers'][] = $reducer;
    }

    public function importSelector(string $store, string $selector)
    {
        $this->initImportReducer($store);
        $this->importedStores[$store]['selectors'][] = $selector;
    }

    private function initImportReducer($store)
    {
        if (!array_key_exists($store, $this->importedStores)) {
            $this->importedStores[$store] = [
                'reducers' => [],
                'selectors' => []
            ];
        }
    }

    public function getInitialState()
    {
        return $this->initialState->all();
    }

    public function getReducers()
    {
        return $this->reducers;
    }
}