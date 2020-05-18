<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;

class FileController extends Controller
{
    const SUPPORTED_TYPES = [
        'jpeg',
        'bmp',
        'png',
        'gif',
        'pdf',
        'doc',
        'txt'
    ];

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES)
        ]);

        $filename = $this->formatFileName($request->file("file")) . '.' . $request->file("file")->extension();
        $filepath = date("Y-m-d"); // for now just use current date

        // setting full path of file
        $file_url = env('MINIO_URL') . '/'
            . env('MINIO_BUCKET') . '/'
            . $filepath . '/'
            . $filename;

        // upload image to media bucket
        $fp = fopen($request->file("file"), "r");
        $isSuccess = Storage::disk('minio')->put($filepath . '/' . $filename, $fp);

        $data = [
            'success' => ($isSuccess) ? true : false,
            'file' => $file_url,
        ];

        return response()->json($data);
    }

    private function formatFileName($request_file) {
        return $filename_no_ext = date("His") . '-'
            . str_slug(
                rtrim($request_file->getClientOriginalName(), "." . $request_file->extension()),
                '_'
            );
    }
}
