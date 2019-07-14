<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Aws\S3\MultipartUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends AppBaseController
{
    public function upload(Request $request)
    {
        if (!$request->has('file')) {
            return $this->sendError('No files found');
        }
        $file = $request->get('file');
        if ($file == null) {
            return $this->sendError('Invalid file uploaded');
        }
        $path = '';
        $name = uniqid('image') . '.jpeg';
        $full_name = $path . '/' . $name;

        \Image::make($file)->save('storage' . $full_name, 70);

        //$uploader = new MultipartUploader();
        if (Storage::disk('public')->exists($full_name)) {
            $data = [
                'url' => $full_name,
            ];
            return $this->sendResponse($data, 'File uploaded successfully');
        } else {
            return $this->sendError('An error occurred while uploading file', 500);
        }
    }
}
