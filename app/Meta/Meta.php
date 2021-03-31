<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 24.03.2021
 * Time: 18:54
 */

namespace App\Meta;


use Latte\Engine;

abstract class Meta
{
    protected $filename;

    const TEMPLATE = '';

    /**
     * Meta constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }


    public function export(): void
    {
        $latte = new Engine();
        $latte->setTempDirectory(__DIR__ . '/../temp');
        $directory = dirname($this->filename);
        if (!file_exists($directory)) {
            mkdir($directory, '0777', true);
        }
        file_put_contents($this->filename, $latte->renderToString(__DIR__ . '/../templates/' . static::TEMPLATE . '.latte', get_object_vars($this)));
        echo $this->filename . "\n";
    }
}