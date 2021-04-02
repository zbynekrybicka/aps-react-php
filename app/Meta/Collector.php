<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 02.04.2021
 * Time: 7:11
 */

namespace App\Meta;


class Collector extends Meta
{

    const TEMPLATE = 'collector';

    protected $data;

    /**
     * Collector constructor.
     * @param string $filename
     */
    public function __construct($filename, $data, $primaryCell)
    {
        parent::__construct($filename);
        $this->primaryCell = $primaryCell;
        $this->data = $data;
    }
}