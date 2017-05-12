<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 11.05.17
 * Time: 23:37
 */

namespace App\Services;


use Illuminate\Http\UploadedFile;

class ImageService
{

    public static function move(UploadedFile $image, $folder, $name = null) {

        $name = isset($name) ? $name . '.' . $image->clientExtension() : $image->getFilename();

        $folder = trim($folder, '/');

        $image->move(public_path($folder), $name);

        return '/' . $folder . '/' . $name;

    }

}