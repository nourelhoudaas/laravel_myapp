<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadFile extends Controller
{
    //
    public function uploadFile(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'id_nin'=>'required|integer',
        ]);
        $id=$request->get('id_nin');
        $sous_dir=$request->get('sous');
        $directory = "public/employees/Em_{$id}/{$sous_dir}";

        // Check if the directory exists, and create it if it doesn't
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        $file = $request->file('file');
        $path = $file->storeAs($directory, $file->getClientOriginalName());

        return back()->with('success', 'File uploaded successfully.');
    }
    public function cree_dos_sous(Request $request)
    {
        // Define the main directory path
        $request->validate([
            'id_nin'=>'required|integer',
        ]);
        $id=$request->get('id_nin');
       // $sous_dir=$request->get('sous');
        $mainDirectoryPath = storage_path('app/public/employees/Em_'.$id);

        // Define the subdirectory path inside the main directory
        $folder=['Admin','Niveaux','Congé','Social','Contonsion','Promotion','Maladie','Personnel'];
        for($i=0;$i<count($folder);$i++)
        {
        $subDirectoryPath[$i] = $mainDirectoryPath . '/'.$folder[$i];
        }

        // Create the main directory if it doesn't exist
        if (!File::exists($mainDirectoryPath)) {
            File::makeDirectory($mainDirectoryPath, 0777, true);
            echo "Main directory created successfully.<br>";
        } else {
            echo "Main directory already exists.<br>";
        }

        // Create the subdirectory inside the main directory
        for($i=0;$i<count($subDirectoryPath);$i++)
        {
        if (!File::exists($subDirectoryPath[$i])) {
            File::makeDirectory($subDirectoryPath[$i], 0777, true);
            echo "Subdirectory created successfully.";
        } else {
            echo "Subdirectory already exists.";
        }
     }
    }

    public function getFiles($id)
    {
        $files = [];
        $empdoss='employees/Em_'.$id;
        $directory = storage_path('app/public/employees/Em_'.$id);
        foreach (File::directories($directory) as $subDir) {
            $subDirName = basename($subDir);
            $filesEm = File::files($subDir);
            $fileNames = array_map(function($file) {
                return basename($file);
            }, $filesEm);

            $files[$subDirName] = $fileNames;
        }
        
        return view('BioTemplate.file_Index',compact('files','empdoss'));
    }
    public function live_File($directory,$subdir,$filename)
    {
        $path =$directory .'/'.$subdir. '/' . $filename;
         dd($path);
        if (Storage::disk('public')->exists($path)) {
            $file = Storage::disk('public')->path($path);
            $mimeType = Storage::disk('public')->mimeType($path);

            return response()->file($file, [
                'Content-Type' => $mimeType
            ]);
        } else {
            return abort(404, 'File not found');
        }
    }
}
