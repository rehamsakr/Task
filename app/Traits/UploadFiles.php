<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;

trait UploadFiles
{
    protected string $pathImages = 'uploads/';

    public function uploadFile($file, $path, $oldFile = null): string
    {
        if($file) {
            // Rename File
            $rename = $file->hashName();
            // Path File
            $fullPath = $file->storeAs($this->pathImages . $path, $rename, 'public_media');
            // Delete Old Files
            if($oldFile) {
                $this->deleteFile($oldFile);
            }
            return $fullPath;
        }
        return $oldFile;
    }


    /**
     * Delete Images from folders
     * @param $file
     * @return bool
     */
    public function deleteFile($file): bool
    {
        $this->destroyFile($file);
        return true;
    }

    private function destroyFile($file)
    {
        // Delete Image from images folder
        File::delete($file);
    }

}
