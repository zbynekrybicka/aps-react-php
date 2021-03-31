<?php
namespace App\Service;


use App\Request;
use App\Response;

class GoogleImageSearch extends ImageInsert
{
    public function search(Request $request)
    {
        $googleSearch = file_get_contents('https://www.google.com/search?q=' . $request->value('search') . '&tbm=isch');
        preg_match_all('/img.*src="(.*)"/U', $googleSearch, $results);
        $images = $results[1];
        array_shift($images);
        preg_match_all('/<a href="\/url\?q=(.*)&/U', $googleSearch, $results);
        $links = $results[1];
        $result = [];
        foreach ($images as $index => $image) {
            $result[] = [
                'image' => $image,
                'link' => $links[$index * 2]
            ];
        }
        return new Response(200, $result);
    }


    public function getImageByGoogleUrl(Request $request)
    {
        $url = urldecode($request->value('url'));
        $server = preg_replace('/(https?:\/\/.*)\/.*$/U', '$1', $url);
        $path = preg_replace('/\/[^\/]*$/U', '', $url);
        @$page = file_get_contents($url);
        if ($page) {
            preg_match_all('/img.*src="(.*)"/U', $page, $results);
            $images = $results[1];
            $imageResults = [];
            foreach ($images as $image) {
                if (@!getimagesize($image)) {
                    if ($image[0] === '/') {
                        $filename = $server . $image;
                        if (@getimagesize($filename)) {
                            $imageResults[] = $filename;
                        }
                    } else {
                        $filename = $path . $image;
                        if (@getimagesize($filename)) {
                            $imageResults[] = $filename;
                        }
                    }
                } else {
                    $imageResults[] = $image;
                }
            }
            return new Response(200, $imageResults);
        } else {
            return new Response(500, 'pageNotLoaded');
        }
    }


    public function insertSelectedImages(Request $request)
    {
        foreach ($request->value('selected') as $url) {
            $this->copyImageFromUrl($url, $request->getUser()->id, $request->value('search'));
        }
        return new Response(201, $request->data());
    }
}