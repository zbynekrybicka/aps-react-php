<?php

namespace App\Process;

use App\Relation\Component;

class PlusImageUrl
{

    public static function execute(Component $plusImageUrl)
    {
        $plusImageUrl->element('input')
            ->className('url')
            ->param('type')->value('text')
            ->event('change')->reducer('checkImage')->line('*.uploadImageData.url = action.payload')->end()
            ->end();

        $plusImageUrl->element('input')
            ->className('category')
            ->param('type')->value('text')
            ->event('change')->reducer('setCategory')->line('*.uploadImageData.category = action.payload')->end()
            ->end();

        $plusImageUrl->element('button')->label('Nahrát vybraný obrázek')
            ->className('uploadImage')
            ->event('click')->ajax('postImage')->selector('imageUrl')->path('*.uploadImageData')
                ->post()->url('/images')->authorization('*.authToken')->data('*')->apiClass('imageUpload')->method('copyFromUrl')
                ->setBeforeAfterAsPreloader()
                ->success()->line('state.side = false')
                ->errorMessage()
                ->end()
            ->end();

        $plusImageUrl->element('img')
            ->param('src')->selector('image')->path('*.uploadImageData.url')
            ->end();

    }

}