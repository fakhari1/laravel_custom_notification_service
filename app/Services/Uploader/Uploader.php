<?php

namespace App\Services\Uploader;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class Uploader
{
    private static $request;
    private static $file;

    public static function upload(Request $request)
    {
        self::$request = $request;
        self::$file = $request->file;

        self::putFileIntoStorage();
        return self::saveFileToDB();
    }

    private static function saveFileToDB()
    {
        $file = new File([
            'name' => self::generateFileName(),
            'size' => self::$file->getSize(),
            'type' => self::getFileType(),
            'is_private' => self::isPrivate()
        ]);

        $file->time = self::getTime($file) ?? null;

        $file->save();
    }

    private static function getTime(File $file)
    {

    }

    private static function putFileIntoStorage()
    {
        $fileName = self::generateFileName();
        $fileType = self::getFileType();

        $method = self::isPrivate() ? 'putFileAsPrivate' : 'putFileAsPublic';

        StorageManager::$method($fileName, self::$file, $fileType);
    }

    private static function getFileType()
    {
        return [
            'image/jpeg' => 'image',
            'video/mp4' => 'video',
            'application/zip' => 'archive'
        ][self::$file->getClientMimeType()];
    }

    private static function isPrivate()
    {
        return self::$request->has('is_private');
    }

    private static function generateFileName()
    {
        $now = Carbon::now();
        $time = time();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $extension = str()->lower(self::$file->getClientOriginalExtension());

        return "file_{$year}{$month}{$day}_{$time}.{$extension}";
    }
}
