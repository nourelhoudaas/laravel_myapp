<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Fichier;
use App\Models\Stocke;
use App\Models\Dossier;
class UploadFile extends Controller
{
    //
    public function uploadFile(Request $request)
    {
        // Validate the file
        $date=Carbon::now();
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
        
        $date=Carbon::now();
$hash= Str::random(40) . '.' .$file->getClientOriginalExtension() ;
$fich=Fichier::select('id_fichier')->where('nom_fichier',$request->get('fichier'))->get();
$path = $file->storeAs($directory, $hash);

/** Converting size */ 
 
$units = ['B', 'KB', 'MB', 'GB', 'TB'];
$size=$file->getSize();
for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
    $size /= 1024;
}

$sizeR=round($size, 2) . ' ' . $units[$i];

/** ---- */
$fich=Fichier::select('id_fichier')->where('nom_fichier',$request->get('fichier'))->get();
        if($fich->count() < 1){
        $save=new Fichier(['nom_fichier'=>$file->getClientOriginalName(),
                                              'hash_fichier'=>$hash,
                                              'date_cree_fichier'=>$date,
                                              'type_fichier'=>$file->getClientOriginalExtension(),
                                              'taille_fichier'=>$sizeR
                                            ]);
                                            $save->save();
                                        }
                                        
        else
        {
            return response()->json([
                'message'=>'unsuccess',
                'status'=>302
            ]);
        }




      return response()->json([
            'message'=>'success',
            'status'=> 200,
            'data'=>['ref_d'=>'Em_'.$id,
                     'sous_d'=>$sous_dir,
                     'filename'=>$file->getClientOriginalName(),
                     'filenext'=>$file->getClientOriginalExtension(),
                     'filesize'=>$sizeR
                    ]
        ]);
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
       /* $dossier=new Dossier([
            'ref_Dossier'=>'Em_'.$id,
        ]);
        if(!$dossier->save())
        {
            return view(404,'Abort');
        }*/
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
        $empdepart=Departement::get();
        $employe=Employe::where('id_nin',$id)->firstOrFail();
       
        $files = [];
        $empdoss='employees/Em_'.$id;
        $directory = storage_path('app/public/employees/Em_'.$id);
        foreach (File::directories($directory) as $subDir) {
            $subDirName = basename($subDir);
            $filesEm = File::files($subDir);
          //  $id=Fichier::where('hash_fichier',basename($filesEm))->select('id_fichier')->first();
            $fileNames = array_map(function($file) {
               $id =Fichier::where('hash_fichier',basename($file))->select('id_fichier')->first();
                
                return $id->id_fichier;
            }, $filesEm);
            $files[$subDirName]=$fileNames;
        }
       // dd(app()->getLocale());
        return view('BioTemplate.file_Index',compact('files','empdoss','empdepart','employe'));
    }
    public function live_File($directory,$subdir,$filename)
    {
        $id=explode('-',$filename);
        $subd=$id[0];
        $numid=intval($id[1]);
        $file=Fichier::where('id_fichier',$numid)->select('hash_fichier')->first();
        $path =$directory .'/'.$subdir. '/' .$subd.'/'.$file->hash_fichier;
        //dd($path);
        return redirect()->to('storage/' .$path);
    }
    public function savedb(Request $request)
    {  
       
        $file=$request->get('fichier');
        
        $date=Carbon::now();
        $fich=Fichier::select('id_fichier')->where('nom_fichier',$request->get('fichier'))->get();
        $doss=Dossier::select('ref_Dossier')->where('ref_Dossier',$request->get('ref_d'))->get();
        //dd($fich)
        $sdoss=new Dossier(['ref_Dossier'=> $request->get('ref_d')]);
       

        if($doss->count() < 1)
        {
            $sdoss=new Dossier(['ref_Dossier'=> $request->get('ref_d')]);
            $dsta=$sdoss->save();
       
        //dd($sdoss);
        if(!$dsta)
        {
            return response()->json([
                'message'=> 'unsuccess of creation Files',
                'status'=>302
            ]);
        }
    }
        else 
        {
           
          $output = [];
          $mac='notfound';
          exec('getmac', $output);
      
          // Search for the MAC address
          foreach ($output as $line) {
            if (preg_match('/([0-9A-F]{2}[-:]){5}([0-9A-F]{2})/i', $line, $matches)) {
                $mac=$matches[0];
            }
            }
           // dd($request);
            $stock=new Stocke([
                               'id'=>$request->get('id'),
                               'ref_Dossier'=>$request->get('ref_d'),
                               'sous_d'=>$request->get('sous_d'),
                                'id_fichier'=>$fich[0]->id_fichier,
                                'date_insertion'=>$date,
                                'mac'=>$mac,
                        
        ]);
        //dd($stock);
        if($stock->save())
        {
            return response()->json([
                'message'=>'success'.$mac,
                'status'=>200
            ]);

        }else
        {
            return response()->json([
                'message'=>'unsuccess',
                'status'=>302
            ]);
        }
        }
        /*else
        {
            return response()->json([
                'message'=>'unsuccess file insert',
                'status'=>404
            ]);
        }*/
    }
    public function getname($id)
    {
        if($id)
        {
        $name=Fichier::where('id_fichier',$id)->select('nom_fichier')->first();
        return response()->json([
            'name'=>$name->nom_fichier,
            'status'=> 200
        ]);
        }
        else{
            return response()->json([
                'name'=>'Aucun',
                'status'=> 302
            ]);
        }
    }
}
