<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(FileUploadRequest $request)
    {
        $fileName = $request->input('fileName');
        $file = $request->file('file');
        $uploadDir = base_path('uploads');
        $filePath = $uploadDir . '/' . $fileName;


        // Save the file to the uploads directory
        if ($file->move($uploadDir, $fileName)) {
            // File successfully uploaded, return a response with status code 201
            return response()->json(['message' => 'File uploaded successfully'], 201);
        } else {
            // Failed to upload the file, return a response with status code 500
            return response()->json(['message' => 'Failed to upload the file'], 500);
        }
    }

    public function download(Request $request)
    {
        $request->validate([
            'fileName' => 'required|string',
        ]);

        $fileName = $request->input('fileName');
        $filePath = base_path() . '/uploads/' . $fileName;
        // Check if the file exists in the uploads directory
        if (file_exists($filePath)) {
            // Return the file as a response with status code 200
            return response()->download($filePath);
        } else {
            // Return status code 404 if the file does not exist
            return response()->json(['message' => 'File not found'], 404);
        }
    }
}
