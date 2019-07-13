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
    public function uploadToS3(Request $request)
    {
        if (!$request->has('file')) {
            return $this->sendError('No files found');
        }
        $file = $request->get('file');
        if ($file == null) {
            return $this->sendError('Invalid file uploaded');
        }
        $path = '';
        $name = Str::random(20) . '.jpeg';
        $full_name = $path . '/' . $name;

        //$uploader = new MultipartUploader();
        if (Storage::disk('public')->put($full_name, $file, 'public')) {
            $data = [
                'url' => config('filesystems.disks.public.url').$full_name,
            ];
            return $this->sendResponse($data, 'File uploaded successfully');
        } else {
            return $this->sendError('An error occurred while uploading to S3', 500);
        }
    }
}
