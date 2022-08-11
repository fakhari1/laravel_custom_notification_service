<?php

namespace App\Services\Uploader;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager
{

    public static function putFileAsPrivate(string $fileName, UploadedFile $file, string $fileType)
    {
        return Storage::disk('private')->putFileAs($fileType, $file, $fileName);
    }

    public static function putFileAsPublic(string $fileName, UploadedFile $file, string $fileType)
    {
        return Storage::disk('public')->putFileAs($fileType, $file, $fileName);
    }

    public function getFile(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->download($this->directoryPrefix($name, $type));
    }

    private function directoryPrefix(string $name, string $type)
    {
        return $type . DIRECTORY_SEPARATOR . $name;
    }

    private function disk(bool $isPrivate)
    {
        $disk = $isPrivate ? 'private' : 'public';
        return Storage::disk($disk);
    }

    public function deleteFile(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->delete($this->directoryPrefix($name, $type));
    }
}
