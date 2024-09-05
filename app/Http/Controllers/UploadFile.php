<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Departement;
use App\Models\Post;
use App\Models\Employe;
use App\Models\Fichier;
use App\Models\Stocke;
use App\Models\Dossier;
use App\Services\logService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use SSZipArchive;
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
        $ups='Opération réussie';
        $upsnot='Echec D` Opération';
        if(app()->getLocale() == 'ar')
        {
            $ups=' تم بنجاح ';
            $upsnot='خطا في العملية';
        }
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
                                            }
                                            //  dd($save);
                     
                                        
        else
        {
            return response()->json([
                'message'=> $upsnot,
                'status'=>302
            ]);
        }

        


      return response()->json([
            'message'=>$ups,
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
        $ups='Opération réussie';
        $upsnot='Echec D` Opération';
        if(app()->getLocale() == 'ar')
        {
            $ups=' تم بنجاح ';
            $upsnot='خطا في العملية';
        }
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
        return response()->json(['success'=>$ups,'code'=>200]);
    }

    public function getFiles($id)
    {
        App::setLocale(Session::get('locale', config('app.locale')));
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
        $ups='Opération réussie';
        $upsnot='Echec D` Opération';
        if(app()->getLocale() == 'ar')
        {
            $ups=' تم بنجاح ';
            $upsnot='خطا في العملية';
        }
        $id=explode('-',$filename);
        $subd=$id[0];
        $numid=intval($id[1]);
        if($numid == 0)
        {
            return response()->json([
                'message'=> $upsnot,
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
        $ups='Opération réussie';
        $upsnot='Echec D` Opération';
        if(app()->getLocale() == 'ar')
        {
            $ups=' تم بنجاح ';
            $upsnot='خطا في العملية';
        }
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
                'message'=>  $upsnot,
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
                'message'=>$ups,
                'code'=> 200
            ]);

        }else
        {
            return response()->json([
                'message'=>$upsnot,
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
    public function export_fichier($id)
    {
        $empdoss='employees/Em_'.$id;
        $folderPath = storage_path('app/public/'.$empdoss);
        $hash= Str::random(40); // Path to the folder you want to zip
        $zipFilePath = storage_path('app/public/'.$hash.'.zip');// Path to save the ZIP file
        $password = 'pers-mcomm-'.$id.''; 
        //dd($password);
        $zip = new \ZipArchive();
        
        $result = $zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
       // dd($result);
        if ($result !== true) {
            return response()->json(['error' => 'Failed to create ZIP file. Error code: ' . $result]);
        }
        // Set password for the ZIP file
        $zip->setPassword($password);

        // Add files to the ZIP archive
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath));
        foreach ($files as $file) {
            // Skip directories
            if (!$file->isDir()) {
                // Add file to the ZIP and set password for it
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderPath) + 1);
                $zip->addFile($filePath, $relativePath);
                $zip->setEncryptionName($relativePath, \ZipArchive::EM_AES_256);
            }
        }

        $zip->close();

        // Return the ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
     
    }
    function create_ats(Request $request)
    {
        $emp=Employe::join('occupes','occupes.id_nin','=','employes.id_nin')
                     ->orderBy('occupes.date_recrutement','desc')
                     ->where('employes.id_nin',$request->get('ID_NIN'))->first();
        $fullname=$emp->Nom_emp.' '.$emp->Prenom_emp;
        $fullnamear=$emp->Nom_ar_emp.' '.$emp->Prenom_ar_emp;
        $datenai=$emp->Date_nais;
        $id_post=$emp->id_post;
        $date_rec=$emp->date_recrutement;
        $post=Post::select('Nom_post','Nom_post_ar')
                   ->where('id_post',$id_post)
                   ->first();
/***------------------------------------------------------------ */
                   Carbon::setLocale('fr');
                   $date = Carbon::parse($datenai);
                   $date_rec=Carbon::parse($date_rec);
                   // Format the date to show the month name
                   $datefr = $date->translatedFormat('l, d F Y');
                   $date_rfr =$date_rec->translatedFormat('l, d F Y');
/***------------------------------------------------------------------ */
                   $date = Carbon::parse($datenai);
                   Carbon::setLocale('ar');
                   $datear = $date->translatedFormat('l, d F Y');
                   $date_rar =$date_rec->translatedFormat('l, d F Y');

/***-------------------------------------------------------------- */
        $latex = '
\documentclass[a4paper]{article}
\usepackage[left=2cm, right=2cm, top=1cm, bottom=3cm]{geometry}
\usepackage{fontspec}
\usepackage{arabxetex}
\usepackage[absolute,overlay]{textpos}
% Set the main font to a font that supports Arabic script
\setmainfont{Arial}

\begin{document}

\title{\textarab{الجمهورية الجزائرية الديمقراطية الشعبية} \\\Republique Algerienne Democratique et populaire }
\author{\textarab{وزارة الإتصال} \\\ Minister De La Communication}

\maketitle
Direction de L Admission et des Moyens. \hfill  \textarab{ المديرية الإداة و الوسائل العامة} \\\
Sous-Direction Des Personnels. \hfill  \textarab{ المديرية الفرعية للمستخدمين } \\\
N°: \hspace{1cm}   /SDP/DAM/MC/2024 . \hfill  \textarab{ رقم:\hspace{1cm}    م ف م/م ا و/و إ/2024 }

\begin{center}
\textarab{شهادة عمل} \\\
ATTESTATION DE TRAVAIL
\end{center}
\begin{flushleft}
\hspace{1cm} Les sous-directeur des personnls certifie par la present que Monsieur \textbf{'.$fullname.'} ne '.$datefr.' , a Blida, Occupe le Grade d \textbf{'.$post->Nom_post.'}, aus Niveau du Ministere de La Communication, De puis le \textbf{'.$date_rfr.'},a ce jour \\\
\hspace{1cm} en foi de quoi cette attestation est établie
\end{flushleft}
\begin{flushright}
\hspace{1cm}\textarab{يشهد المدير الفرعي للمستخدمين با السيد \textbf{\textarab{'.$fullnamear.'}} المولود في '.$datear.'  ، الشاغر منصب \textbf{\textarab{'.$post->Nom_post_ar.'}}  و ذلك إبتداء من \textbf{\textarab{ '.$date_rar.'}} إلى يومنا هذا .} \\\
\textarab{ تم تحرير هذه الشهادة لمى يسمح به القانون  }
\end{flushright}

\vspace*{\fill}
 
\textarab{حررة ب \hspace{1cm}} \hfill  Faite Le : \hspace{1cm} a :
\end{document}';
            // Define paths
            $storagePath = storage_path('app/public/employees/Em_'.$request->get('ID_NIN'));
            $texFile = $storagePath . DIRECTORY_SEPARATOR . 'report.tex';
            $pdfFile = $storagePath . DIRECTORY_SEPARATOR . 'report.pdf';
    
            // Ensure the storage directory exists
            if (!is_dir($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
    
            // Save LaTeX code to a temporary .tex file
            file_put_contents($texFile, $latex);
    
            // Compile LaTeX code to PDF using xelatex
            $output = shell_exec("xelatex -output-directory={$storagePath} {$texFile}");
    
            // Return the PDF as a download
            if (file_exists($pdfFile)) {
                return redirect()->to('storage/employees/Em_'.$request->get('ID_NIN').'/report.pdf');
            } else {
                return response('Failed to generate PDF', 500);
            }
    }
    function read_report($id)
    {
        return redirect()->to('storage/employees/Em_'.$id.'/report.pdf');
    }
}
