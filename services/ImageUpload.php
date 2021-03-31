<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 28.03.2021
 * Time: 5:49
 */

namespace App\Service;


use App\Resource\Db;
use App\Request;
use App\Response;

class ImageUpload extends ImageInsert
{
    public function copyFromUrl(Request $request)
    {
        if ($user = $request->getUser()) {
            $url = $request->value('url');
            $result = $this->copyImageFromUrl($url, $user->id, $request->value('category'));
            switch($result) {
                case 0:
                    return new Response(204, null);

                case 1:
                    return new Response(400, 'DuplicateImage');

                case 2:
                    new Response(400, 'ImageNotFound');
            }
        } else {
            return new Response(401, null);
        }
    }

}