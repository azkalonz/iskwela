<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Storage;

trait File
{
    /**
     * Undocumented variable
     *
     * @var string the root folder of the file, usually it is the school code e.g. SCHOOL01
     */
    protected static $root_path;

    public static function setRootPath(string $root_path)
    {
        static::$root_path = $root_path;
    }

    /**
     * Uploading file to storage disk
     * 
     * @param UploadedFile $file 
     * @param string @root_path usually it's the School Code
     * @return string|false complete path of file 
     */
    public function uploadFile(UploadedFile $file, $root_path = null)
    {
        $filename = $this->formatFileName($file) . '.' . $file->extension();
        
        // setting full path of file
        if(!$root_path) {
            $root_path = $this->getRootPath();
        }
        $full_path =  $root_path . '/' . date("Y-m-d") . '/' . $filename;

        // upload image to media bucket
        $fp = fopen($file, "r");

        if( Storage::disk('do')->put($full_path, $fp) ) {
            return $full_path;
        }
        
        return false;
    }

    /**
     * Downloading file from storage disk 
     * 
     * @param string $full_file_path complete path of file including the root path 
     *      e.g SCHOOL01/2020-05-19/165145-image_3.png
     * @return mixed the file itself
     */
    public function downloadFile(string $full_file_path)
    {
        return Storage::disk('do')->download($full_file_path);
    }

    /**
     * Root path directory of files should be the school code
     *
     * @return void
     */
    private function getRootPath()
    {
        return static::$root_path ?: env('SCHOOL_CODE');
    }

    private function formatFileName($file)
    {
        return date("His") . '-'
            . Str::slug(
                rtrim($file->getClientOriginalName(), "." . $file->extension()),
                '_'
            );
    }

    /**
     * Upload file to public space
     */
    public function uploadToPublicSpace(UploadedFile $file, $root_path = null)
    {
        // setting full path of file
        if(!$root_path) {
            $root_path = $this->getRootPath();
        }
        $full_path =  sprintf("%s/public", $root_path);

        if ($do_path = Storage::disk('do')->putFile($full_path, $file, 'public')) {
            return $do_path;
        }
        return false;
    }

    /**
     * returns the public url of the file
     */
    public function getFilePublicUrl(String $file_path)
    {
        return Storage::disk('do')->url($file_path);
    }
}