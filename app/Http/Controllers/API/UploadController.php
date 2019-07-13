<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends AppBaseController
{
    public function uploadToS3(Request $request)
    {
        if (!$request->hasFile('file')) {
            $this->sendError('No files found');
        }
        $file = $request->file('file');
        if (!$file->isValid()) {
            $this->sendError('No seems corrupted');
        }
        $path = 'attachments';
        $name = Str::random(20) . $file->guessExtension();
        if ($file->storePubliclyAs($path, $name)) {
            $data = [
                'url' => config('filesystems.disks.s3.url').$path.'/'.$name,
            ];
            $this->sendResponse($data, 'File uploaded successfully');
        } else {
            return $this->sendError('An error occured while uploading to S3', 500);
        }
    }
}
