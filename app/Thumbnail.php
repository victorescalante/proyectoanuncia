<?php

namespace Anuncia;

use Intervention\Image\Facades\Image;

Class Thumbnail {

    public function make($src,$destination,$size=280)

    {
        Image::make($src)

            ->fit($size)

            ->save($destination);
    }

}