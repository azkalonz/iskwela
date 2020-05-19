<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Traits\File;

use Storage;

class FileController extends Controller
{
    use File;

    const SUPPORTED_TYPES = [
        'image/jpeg',
        'image/bmp',
        'image/png',
        'image/gif',
        'application/pdf',
        'application/doc',
        'text/plain'
    ];

    private function getRootPath() {
        return env('SCHOOL_CODE');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:' . implode(',', self::SUPPORTED_TYPES)
        ]);

        $full_path = $this->uploadFile($request->file("file"));

        $data = [
            'success' => ($full_path) ? true : false,
            'file' => $full_path,
        ];

        return response()->json($data);
    }

    public function download(Request $request)
    {
        $request->validate([
            'file' => 'required|string'
        ]);

        return $this->downloadFile( $request->input('file') );
    }

    private function formatFileName($request_file) {
        return $filename_no_ext = date("His") . '-'
            . Str::slug(
                rtrim($request_file->getClientOriginalName(), "." . $request_file->extension()),
                '_'
            );
    }
}
