<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UploadFile extends Controller
{
    //
    public function uploadFile(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'num'=>'required|integer',
        ]);
        $id=$request->get('num');
        $directory = "public/employees/{$id}";

        // Check if the directory exists, and create it if it doesn't
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $file = $request->file('file');
        $path = $file->storeAs($directory, $file->getClientOriginalName());

        return back()->with('success', 'File uploaded successfully.');
    }
}
