<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 11.05.17
 * Time: 23:37
 */

namespace App\Services;


use Illuminate\Http\UploadedFile;
use File;

class FileService
{

    public static function move(UploadedFile $file, $folder, $name = null) {

        $name = isset($name) ? $name . '.' . $file->clientExtension() : $file->getClientOriginalName();

        $folder = trim($folder, '/');

        $file->move(public_path($folder), $name);

        return '/' . $folder . '/' . $name;

    }

    public static function removeFolder($path) {

        File::deleteDirectory($path);

    }

}