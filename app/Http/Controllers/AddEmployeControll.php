<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Employe;
use App\Models\Bureau;
use App\Models\Sous_departement;
use App\Models\Travail;
use App\Models\Occupe;
use App\Models\Contient;
use App\Models\appartient;
use App\Models\Niveau;
use App\Models\Post;
use App\Models\Departement;

class AddEmployeControll extends Controller
{
    //
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function add(Request $Request)
    {
       // dd($Request);
       $Request->validate([
        'ID_NIN' => 'required|integer',
    ]);
        $employees=new Employe();
        $employees=$employees->get();
        $bureau=new Bureau();
          $Direction=new Sous_departement();
          $niv=new Niveau();

       //   $Containt=new Containt();
       if(isset($employees))
       {
            foreach($employees as $em)
        {


            if($Request->get('ID_NIN') ==  $em->id_nin)
            {

                return redirect()->route('Employe.istravaill',["id"=>$em->id_nin]);
            }
        }

            $Request->validate([
                'ID_NIN' => 'required|integer',
                'Nom_P' => 'required|string',
                'Prenom_O' => 'required|string',
                'Nom_PAR' => 'required|string',
                'Prenom_AR' => 'required|string',
                'Date_Nais_P' => 'required|date',
                'Lieu_N' => 'required|string',
                'Lieu_AR' => 'required|string',
                'Address' => 'required|string',
                'AddressAR' => 'required|string',
                'Sexe'=>'required|string',
                'EMAIL'=>'required|string',
                'PHONE_NB'=>'required|integer',
            ]);
          //  dd($Request);
            $employe = new Employe([
                'id_nin' => $Request->get('ID_NIN'),
                'id_p' => rand(1, 100),
                'Nom_emp' => $Request->get('Nom_P'),
                'Prenom_emp' => $Request->get('Prenom_O'),
                'Nom_ar_emp' => $Request->get('Nom_PAR'),
                'Prenom_ar_emp' => $Request->get('Prenom_AR'),
                'Date_nais' => $Request->get('Date_Nais_P'),
                'Lieu_nais' => $Request->get('Lieu_N'),
                'Lieu_nais_ar' => $Request->get('Lieu_N'),
                'adress' => $Request->get('Address'),
                'adress_ar' => $Request->get('AddressAR'),
                'sexe'=>$Request->get('Sexe'),
                'email'=>$Request->get('EMAIL'),
                'Phone_num'=>$Request->get('PHONE_NB'),
            ]);
          //  dd($employe);
          
        if($employe->save())
        {
            //$dbcontaint=$Containt->get();
          //  $dbbureau=$bureau->get();
          //  $dbdirection=$Direction->get();
            $dbniv=$niv->get();
            $dbempdepart = new Departement();
            $empdepart =$dbempdepart->get();
            return view('addTemplate.travaill',compact('employe','dbniv','empdepart'));
        }
        else
        {
            return redirect()->back()->with('error', 'Failed to create department. Please try again.');
        }
    }

    }



    public function addToDep(Request $Request)
    {

        $Request->validate([
            'ID_NIN' => 'required|integer',
            'ID_P' => 'required|integer|',
            'ID_D' => 'required|integer',
            'ID_B' => 'required|integer',
            'DatePV'=>'required|date'
        ]);
       // dd($Request);
try {
   $test= DB::table('travails')->insert([
        'id_nin' => $Request->get('ID_NIN'),
        'id_p' => $Request->get('ID_P'),
        'id_sous_depart' => $Request->get('ID_D'),
        'id_bureau' => $Request->get('ID_B'),
        'date_installation'	=>$Request->get('DatePV'),
        'date_chang'=>Carbon::now(),
        'notation'	=>0,
    ]);
} catch (\Exception $e) {
    Log::error('Failed to insert user: ' . $e->getMessage());
}
return redirect()->route('Employe.create')->with('success', 'User created successfully!');
    }



   function existToAdd($id)
  {
    $employe=Employe::where('id_nin', $id)->firstOrFail();
    $niv=new Niveau();
    $dbniv=$niv->get();
    $dbempdepart = new Departement();
    $empdepart =$dbempdepart->get();
    return view('addTemplate.travaill',compact('employe','dbniv','empdepart'));
  }

//------------- add a appartient table

   function existToAddApp(Request $Request)
  {
    $niv=new Niveau();
    $bureau=new Bureau();
    $Direction= new Departement();
      $SDirection=new Sous_departement();
      $dbbureau=$bureau->get();
      $dbsdirection=$SDirection->get();
      $dbdirection=$Direction->get();
      $idn=$niv->ID_N;
    $post=New Post();
       $dbpost=$post->get();
    $id=$Request->get('ID_NIN');
   // dd($id);
    $employe=Employe::where('id_nin', $id)->firstOrFail();
   
    $Appartient=Appartient::where('id_nin', $id)->get();
    if($Appartient->count() > 0)
    {
        //----------------- send To next $etp for Donnée Administration ----------------------
      //  dd($Appartient);
       $post=New Post();
       $dbpost=$post->get();
        $employe=Employe::where('id_nin', $id)->firstOrFail();
     //   dd($employe);
     $dbempdepart = new Departement();
        $empdepart =$dbempdepart->get();
        return view('addTemplate.admin',compact('employe','dbdirection','bureau','dbpost','dbsdirection','empdepart'));
    }
    //---------------- this for add to Level Education and his Diploma -------------------------
    $Request->validate([
      'ID_NIN' => 'required|integer',
      'ID_P' => 'required|integer|',
      'Dip'=>'required|string|',
      'Spec'=>'required|string|',
      'DipDate'=>'required|date'
  ]);
       
        $niv=Niveau::where('Nom_niv',$Request->get('Dip'))
                     ->where('Specialité',$Request->get('Spec'))
                     ->first();
     // dd($niv);
       $idn=$niv->id_niv;
       $Request->validate([
        'DipRef' => 'required|string',
    ]);
        $test= DB::table('appartients')->insert([
             'id_nin' => $Request->get('ID_NIN'),
             'id_p' => $Request->get('ID_P'),
             'id_niv' => $idn,
             'id_appar' => $Request->get('DipRef'),
             'Date_op'	=>$Request->get('DipDate'),
         ]);
         $dbempdepart = new Departement();
        $empdepart =$dbempdepart->get();
         return view('addTemplate.admin',compact('employe','dbbureau','dbsdirection','dbdirection','dbpost','empdepart'));

  }
    function existApp($id)
  {
    $employe=Employe::where('id_nin', $id)->firstOrFail();
    $bureau=new Bureau();
    $Direction= new Departement();
    $SDirection=new Sous_departement();
    $dbsdirection=$SDirection->get();
    $dbdirection=$Direction->get();
    $dbbureau=$bureau->get();
    $dbdirection=$Direction->get();
    $Appartient=Appartient::where('id_nin', $id)->get();
    $post=New Post();
    $dbpost=$post->get();
    $dbempdepart = new Departement();
        $empdepart =$dbempdepart->get();
    return view('addTemplate.admin',compact('employe','dbbureau','dbdirection','dbpost','dbsdirection','empdepart'));
  }
  function GenDecision(Request $request)
  { 
    $request->validate([
      'ID_NIN' => 'required|integer',
      'ID_P' => 'required|integer|',
      'Dic'=>'required|integer|',
      'SDic'=>'required|integer|',
      'post'=>'required|integer|',
      'PVDate'=>'required|date'
  ]);
    
    $travaill=new Travail([
      'date_chang' => Carbon::now(),
      'date_installation'=>$request->get('PVDate'),
      'notation'=>0	,
      'id_nin'=>$request->get('ID_NIN'),	
      'id_sous_depart'=>$request->get('SDic'),	
      'id_p'=>$request->get('ID_P')	,
      'id_bureau'=>206,
    ]);
    //dd($travaill);
  
    if($travaill->save())
    {
      Occupe::create([
        'date_recrutement'=>$request->get('RecDate'),
        'echellant'=>0	,
        'id_nin'=>$request->get('ID_NIN'),	
        'id_p'=>$request->get('ID_P')	,
        'id_post'=>$request->get('post')
      ]);
      return redirect()->back()->with('message',"This is Success Message");
    }
    else
    {
      return redirect()->back()->with('message',"This is UnSuccess Message");
    }
  }
}
