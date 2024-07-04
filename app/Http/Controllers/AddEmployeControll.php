<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Employe;
use App\Models\Bureau;
use App\Models\Sous_departement;
use App\Models\Travail;
use App\Models\Contient;
use App\Models\appartient;
use App\Models\Niveau;
use App\Models\Post;

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
            $dbbureau=$bureau->get();
            $dbdirection=$Direction->get();
            return view('addTemplate.travaill',compact('employe','dbbureau','dbdirection'));
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
    $bureau=new Bureau();
    $Direction=new Sous_departement();;
    $dbbureau=$bureau->get();
    $dbdirection=$Direction->get();
    return view('addTemplate.travaill',compact('employe','dbbureau','dbdirection'));
  }

//------------- add a appartient table

  protected function existToAddApp(Request $Request)
  {
    $Request->validate([
        'ID_NIN' => 'required|integer',
        'ID_P' => 'required|integer|',
        'Dip'=>'required|string|',
        'Spec'=>'required|string|',
        'DipDate'=>'required|date'
    ]);
    $id=$Request->get('ID_NIN');
    $Appartient=Appartient::where('ID_NIN', $id)->get();
    if($Appartient->count() > 0)
    {
        //----------------- send To next $etp for Donnée Administration ----------------------
       // dd($Appartient);
        $employe=Employe::where('ID_NIN', $id)->firstOrFail();
     //   dd($employe);
        return view('addTemplate.admin',compact('employe'));
    }
    //---------------- this for add to Level Education and his Diploma -------------------------

        $niv=new Niveau();
        $niv=Niveau::where('NOM_N',$Request->get('Dip'))
                     ->where('SPECIAL_N',$Request->get('Spec'))
                     ->first();
      //dd($niv);
      $bureau=new Bureau();
      $Direction=new Direction();
      $dbbureau=$bureau->get();
      $dbdirection=$Direction->get();
      $idn=$niv->ID_N;
        $test= DB::table('appartient')->insert([
             'ID_NIN' => $Request->get('ID_NIN'),
             'ID_P' => $Request->get('ID_P'),
             'ID_N' => $idn,
             'Ref_D' => $Request->get('DipRef'),
             'DATE_OP'	=>$Request->get('DipDate'),
         ]);
         return view('addTemplate.admin',compact('employe','dbbureau','dbdirection'));

  }
  protected function existApp($id)
  {
    $employe=Employe::where('id_nin', $id)->firstOrFail();
    $bureau=new Bureau();
    $Direction=new Sous_departement();
    $dbbureau=$bureau->get();
    $dbdirection=$Direction->get();
    $Appartient=Appartient::where('id_nin', $id)->get();
    $post=New Post();
    $dbpost=$post->get();
    return view('addTemplate.admin',compact('employe','dbbureau','dbdirection','dbpost'));
  }
}
