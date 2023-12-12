<?php
namespace App\Services\User;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadFileService
{
    public function uploadFile(UploadedFile $file): string
    {
        try {
            $image = $file->getClientOriginalName();
            Storage::putFileAs('public/upload', $file, $image);
            return $image;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteFile(array $image): bool
    {
        try {
            return Storage::delete('public/upload/' . $image['image']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
