<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 27.03.2021
 * Time: 7:37
 */

namespace App\Service;


use App\Resource\Db;
use App\Request;
use App\Response;

class Algorithm
{

    public function getImages(Request $request)
    {
        if (!$user = $request->getUser()) {
            return new Response(401, null);
        }
        return new Response(200, [
            'images' => $this->loadImages($user->id, $request->value('category') ?: ''),
            'categories' => $this->loadCategories()
        ]);
    }

    private function loadImages(int $userId, string $category)
    {
        $db = Db::get();
        if ($category) {
            $images = $db->select('*')
                ->from('images')
                ->where('category = %s AND user_id = %u', $category, $userId)
                ->fetchAll() ?: [];
        } else {
            $images = $db->select('*')
                ->from('images')
                ->where('user_id = %u', $userId)
                ->fetchAll() ?: [];
        }
        return $this->sortImages($images);
    }

    private function loadCategories()
    {
        return [];
    }

    private function daysAfterInsert($insertedAt)
    {
        $datetime1 = date_create($insertedAt);
        $datetime2 = date_create('now');

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format('%a') + 1;
    }

    private function sortImages($images)
    {
        foreach ($images as $index => &$image) {
            if ($image->views === 0) {
                $score = 0;
            } else {
                $score = $image->seconds / $image->views / (1 + $this->daysAfterInsert($image->inserted_at) / 100);
            }
            $image->score = $score;
        }
        usort($images, function($a, $b) {
            return $a->score > $b->score ? -1 : 1;
        });
        $count = count($images);
        $step = ceil($count / 10);
        $result = [];
        for ($i = 0; $i < 10; $i++) {
            if ($images[$i * $step]) {
                $result[] = $images[$i * $step];
            } else {
                break;
            }
        }
        return $result;
    }

    public function addScore(Request $request)
    {
        $db = Db::get();
        $seconds = time() - $request->value('shownAt');
        $seconds = ($seconds <= 60 ? $seconds : 60) + 1;
        $sql = (string) $db->translate('UPDATE images SET views = views + 1, seconds = seconds + %u WHERE id = %u', $seconds, $request->value('activeId'));
        $db->query($sql);
        return new Response(200, $this->loadImages($request->getUser()->id, ''));
    }

}