<?php

namespace App\Traits;

trait Upload
{

    public function uploadImage($image, $folder)
    {
        $image->store('/', $folder);
        $hashName = $image->hashName();
        return $hashName;
    }


}
