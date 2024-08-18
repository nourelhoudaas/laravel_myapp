<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
use App\Services\logService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
class UploadFile extends Controller
{

/**
 * 
 * Logs Consturcture
 * 
 */
protected $logService;

public function __construct(logService $logService)
{
    $this->logService = $logService;
}



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
$fielname=strval($file->getClientOriginalName());
$ext=strval($file->getClientOriginalExtension());
//dd($request->get('nom_fichier'));
$fich=Fichier::select('id_fichier')->where('nom_fichier',$request->get('nom_fichier'))->get();
$path = $file->storeAs($directory, $hash);
//dd($fielname);
/** Converting size */ 
 
$units = ['B', 'KB', 'MB', 'GB', 'TB'];
$size=$file->getSize();
for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
    $size /= 1024;
}

$sizeR=round($size, 2) . ' ' . $units[$i];

/** ---- */
$fich=Fichier::select('id_fichier')->where('nom_fichier',$request->get('nom_fichier'))->get();
//dd($fich);
      //  if($fich->count() < 1){
        $save=new Fichier(['nom_fichier'=>$fielname,
                                              'hash_fichier'=>$hash,
                                              'date_cree_fichier'=>$date,
                                              'type_fichier'=>$ext,
                                              'taille_fichier'=>$sizeR
                                            ]);
                                            
                                            if($save->save())
                                            {
                                              //at this point we get all list of data all what we had as mac Address so we select one
                                                $mac=$this->logService->getMacAddress();
                                               /* $valmac=strval($mac[0]);
                                                dd($mac);*/
                                                $log= $this->logService->logAction(
                                                    Auth::user()->id,
                                                    $id,
                                                    'Ajouter Un fichier a Em_'.$id."/sous_Dossier :".$sous_dir." Avec Nom".$fielname,
                                                    $mac
                                                );
                                            };
                                            //  dd($save);
                     /*                   }
                                        
        else
        {
            return response()->json([
                'message'=>'unsuccess',
                'status'=>302
            ]);
        }*/

        


      return response()->json([
            'message'=>'success',
            'status'=> 200,
            'data'=>['ref_d'=>'Em_'.$id,
                     'sous_d'=>$sous_dir,
                     'filename'=>$fielname,
                     'filenext'=>$ext,
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
         //   echo "Main directory created successfully.<br>";
        } else {
          //  echo "Main directory already exists.<br>";
        }

        // Create the subdirectory inside the main directory
        for($i=0;$i<count($subDirectoryPath);$i++)
        {
        if (!File::exists($subDirectoryPath[$i])) {
            File::makeDirectory($subDirectoryPath[$i], 0777, true);
         //   echo "Subdirectory created successfully.";
        } else {
         //   echo "Subdirectory already exists.";
        }
     }
        return response()->json(['success'=>'creating file','code'=>200]);
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
           // dd($directory);
           // $id=Fichier::where('hash_fichier',basename($filesEm))->select('id_fichier')->first();
            
            $fileNames = array_map(function($file) {
                $val=strval(basename($file));
                //dd($val);
               $id =Fichier::where('hash_fichier',$val)->select('id_fichier')->first();
                //dd($id);
                if(isset($id))
                {
                    return $id->id_fichier;
                }
                
            }, $filesEm);
            $files[$subDirName]=$fileNames;
        }
       // dd(app()->getLocale());d
     //  dd($files);
       /** ----- paginator for files */
       $perPage = 8; // Par exemple, 2 éléments par page
       $page = 1; // Page actuelle
                           if(request()->get('page') != null && request()->get('subdir') != null)
                           {
                               $page=   request()->get('page');
                               $subDir= request()->get('subdir');
                           } // Page actuelle
       $offset = ($page - 1) * $perPage;
       
       // Extraire les éléments pour la page actuelle
      // $items = $files->slice($offset, $perPage)->values();
       //dd($items);
       
       // Créer le paginator
       $pagearray=array();
       foreach($files as $key=>$value)
       {
      //  dd(gettype($value));
        $valcol=collect($value);
        $items = $valcol->slice($offset, $perPage)->values();
        
       $paginator = new LengthAwarePaginator(
           $items, // Items de la page actuelle
           $valcol->count(), // Nombre total d'éléments
           $perPage, // Nombre d'éléments par page
           $page, // Page actuelle
           [
               'path' =>  LengthAwarePaginator::resolveCurrentPath(), // URL actuelle
               'query' => request()->query() // Paramètres de la requête
           ]
       );
       $paginator->appends([
        'subdir' => $key,
    ]);
       array_push($pagearray,[$key=>$paginator]);
    }
    //   dd($pagearray);

        return view('BioTemplate.file_Index',compact('files','empdoss','empdepart','employe'));
    }


    public function live_File($directory,$subdir,$filename)
    {
        $id=explode('-',$filename);
        $subd=$id[0];
        $numid=intval($id[1]);
        if($numid == 0)
        {
            return response()->json([
                'message'=>'aucun file',
                'code'=> 302
            ]);
        }
        {
        $file=Fichier::where('id_fichier',$numid)->select('hash_fichier')->first();
        $path =$directory .'/'.$subdir. '/' .$subd.'/'.$file->hash_fichier;
        return redirect()->to('storage/' .$path);
        }
        //dd($path);
        
    }


    public function savedb(Request $request)
    {  
       
        $file=$request->get('fichier');
        $date=Carbon::now();
        $fich=Fichier::select('id_fichier')->where('nom_fichier',$request->get('fichier'))->orderBy('date_cree_fichier','desc')->orderBy( 'id_fichier','DESC')->get();
        //dd($fich);
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
                'code'=>302
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
                                'mac'=>strval($mac),
                        
        ]);
        //dd($stock);
        if($stock->save())
        {
            $log= $this->logService->logAction(
                Auth::user()->id,
                $request->get('id_nin'),
                'Stocker Un fichier Num '.$fich[0]->id_fichier,
                strval($mac)
            );
           // dd($stock->save());
            return response()->json([
                'message'=>'success',
                'code'=> 200
            ]);

        }else
        {
            return response()->json([
                'message'=>'unsuccess',
                'code'=>302
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
        $name=explode('.',$name->nom_fichier);
        $date_stock=Stocke::where('id_fichier',$id)->select('date_insertion','id_fichier')->distinct()->first();
      //  dd($name[0]);
      $date_in='N/A';
      if(isset($date_stock->date_insertion))
      {
        $date_in=$date_stock->date_insertion;
      }
        return response()->json([
            'name'=>$name[0],
            'date_insert'=>$date_in,
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
