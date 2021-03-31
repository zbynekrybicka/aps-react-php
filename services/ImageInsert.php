<?php
namespace App\Service;


use App\Resource\Db;
use Dibi\UniqueConstraintViolationException;
use Exception;

class ImageInsert
{

    protected function copyImageFromUrl($url, $userId, $category): int
    {
        try {
            @$isImage = getimagesize($url);
        } catch (Exception $e) {
            $isImage = false;
        }
        if ($isImage) {
            $image = file_get_contents($url);
            $db = Db::get();
            $filename = md5( $url . $userId . time() ) . '.jpg';
            try {
                $db->insert('images', [
                    'user_id' => $userId,
                    'filename' => $filename,
                    'url' => $url,
                    'category' => $category,
                    'inserted_at' => date('Y-m-d')
                ])->execute();
                file_put_contents(__DIR__ . '/../../files/images/' . $filename, $image);
            } catch (UniqueConstraintViolationException $e) {
                return 1;
            }
            return 0;
        } else {
            return 2;
        }

    }

}