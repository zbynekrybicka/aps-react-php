<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 28.03.2021
 * Time: 17:34
 */

namespace App\Resource;


use App\Config;
use Dibi\Connection;

class Db
{
    public static function get()
    {
        static $db = null;
        if (!$db) {
            $config = new Config(__DIR__ . '/../../config.json');
            $db = new Connection((array) $config->db);
        }
        return $db;
    }

}