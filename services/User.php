<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 27.03.2021
 * Time: 0:56
 */

namespace App\Service;

use App\Config;
use App\Request;
use App\Resource\Db;
use App\Response;
use Firebase\JWT\JWT;

class User
{

    public function login(Request $request)
    {
        $db = Db::get();
        $user = $db->select('*')->from('users')->where('username = %s', $request->value('username'))->fetch();
        if (!$user) {
            return new Response(400, 'UserNotFound');
        }
        if (!password_verify($request->value('password'), $user->password)) {
            return new Response(400, 'BadPassword');
        }
        $config = new Config(__DIR__ . '/../../config.json');
        return new Response(200, JWT::encode(['id' => $user->id, 'role' => $user->role], $config->jwt));
    }

}