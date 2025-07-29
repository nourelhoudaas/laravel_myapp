<?php
namespace App\Http\Controllers;

use App\Models\appartient;
use App\Models\Bureau;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Niveau;
use App\Models\Occupe;
use App\Models\Post;
use App\Models\Sous_departement;
use App\Models\Travail;
use App\Services\logService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddEmployeControll extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected $logService;

    public function __construct(logService $logService)
    {
        $this->logService = $logService;
    }

public function add(Request $Request)
{
    // 🔧 Validation initiale du NIN : exactement 20 chiffres
    $Request->validate([
        'ID_NIN' => 'required', // 🔧 Garde ID_NIN obligatoire
    ]);

    $employees = Employe::all();
    $bureau    = Bureau::all();
    $Direction = Sous_departement::all();
    $niv       = Niveau::all();

    // Vérifie si l'employé existe déjà
    if (isset($employees)) {
        foreach ($employees as $em) {
            if ($Request->get('ID_NIN') == $em->id_nin) {
                return redirect()->route('Employe.istravaill', ["id" => $em->id_nin]);
            }
        }
    }

    // 🔧 Validation complète du formulaire (tous les champs sauf ID_NIN sont facultatifs)
    $Request->validate([
        'ID_NIN'      => 'required', // 🔧 Garde ID_NIN obligatoire
        'ID_SS'       => 'nullable|integer',
        'Nom_P'       => 'nullable|string',
        'Prenom_O'    => 'nullable|string',
        'Nom_PAR'     => 'nullable|string',
        'Prenom_AR'   => 'nullable|string',
        'Date_Nais_P' => 'nullable|date',
        'Lieu_N'      => 'nullable|string',
        'Lieu_AR'     => 'nullable|string',
        'Address'     => 'nullable|string',
        'AddressAR'   => 'nullable|string',
        'Sexe'        => 'nullable|string',
        'EMAIL'       => 'nullable|email',
        'PHONE_NB'    => 'nullable',
        'Prenom_Per'  => 'nullable|string',
        'Prenom_mere' => 'nullable|string',
        'Nom_mere'    => 'nullable|string',
        'Prenom_PerAR' => 'nullable|string',
        'Prenom_mereAR' => 'nullable|string',
        'Nom_mereAR'  => 'nullable|string',
        'Situat'      => 'nullable|string',
        'Situatar'    => 'nullable|string',
        'nbrenfant'   => 'nullable|integer',
        'date_nais_per' => 'nullable|date',
        'date_nais_mer' => 'nullable|date',
    ]);

    // 🔧 Liste des champs non-NULLABLE dans la base de données
    $nonNullableFields = [
        'Nom_emp', 'Prenom_emp', 'Nom_ar_emp', 'Prenom_ar_emp', 
        'Lieu_nais', 'Lieu_nais_ar', 'adress', 'adress_ar', 'sexe', 
        'Date_nais', 'prenom_pere', 'prenom_mere', 'nom_mere', 
        'prenom_pere_ar', 'prenom_mere_ar', 'nom_mere_ar', 
        'situation_familliale', 'situation_familliale_ar', 'nbr_enfants'
    ];

    // 🔧 Préparation des données avec gestion des champs vides
    $data = [
        'id_nin'                  => $Request->get('ID_NIN') ?? '',
        'id_p'                    => $Request->get('ID_SS') ? ($Request->get('ID_SS') + 1) : null,
        'NSS'                     => $Request->get('ID_SS') ?? null,
        'Nom_emp'                 => $Request->get('Nom_P') ?? 'null', // 🔧 Non-NULLABLE : "null" si vide
        'Prenom_emp'              => $Request->get('Prenom_O') ?? 'null', // 🔧 Non-NULLABLE
        'Nom_ar_emp'              => $Request->get('Nom_PAR') ?? 'null', // 🔧 Non-NULLABLE
        'Prenom_ar_emp'           => $Request->get('Prenom_AR') ?? 'null', // 🔧 Non-NULLABLE
        'Date_nais'               => $Request->get('Date_Nais_P') ?? '1990-01-01', // 🔧 Non-NULLABLE : date par défaut
        'Lieu_nais'               => $Request->get('Lieu_N') ?? 'null', // 🔧 Non-NULLABLE
        'Lieu_nais_ar'            => $Request->get('Lieu_AR') ?? 'null', // 🔧 Non-NULLABLE
        'adress'                  => $Request->get('Address') ?? 'null', // 🔧 Non-NULLABLE
        'adress_ar'               => $Request->get('AddressAR') ?? 'null', // 🔧 Non-NULLABLE
        'sexe'                    => $Request->get('Sexe') ?? 'null', // 🔧 Non-NULLABLE : "null" si vide
        'email'                   => $Request->get('EMAIL') ?? null,
        'Phone_num'               => $Request->get('PHONE_NB') ?? null,
        'prenom_pere'             => $Request->get('Prenom_Per') ?? 'null', // 🔧 Non-NULLABLE : "null" si vide
        'prenom_mere'             => $Request->get('Prenom_mere') ?? 'null', // 🔧 Non-NULLABLE
        'nom_mere'                => $Request->get('Nom_mere') ?? 'null', // 🔧 Non-NULLABLE
        'prenom_pere_ar'          => $Request->get('Prenom_PerAR') ?? 'null', // 🔧 Non-NULLABLE
        'prenom_mere_ar'          => $Request->get('Prenom_mereAR') ?? 'null', // 🔧 Non-NULLABLE
        'nom_mere_ar'             => $Request->get('Nom_mereAR') ?? 'null', // 🔧 Non-NULLABLE
        'situation_familliale'    => $Request->get('Situat') ?? 'null', // 🔧 Non-NULLABLE : "null" si vide
        'situation_familliale_ar' => $Request->get('Situatar') ?? 'null', // 🔧 Non-NULLABLE : "null" si vide
        'nbr_enfants'             => $Request->get('nbrenfant') ?? 0, // 🔧 Non-NULLABLE : 0 si vide
        'Date_nais_pere'          => $Request->get('date_nais_per') ?? '1990-01-01', // 🔧 Non-NULLABLE : date par défaut
        'Date_nais_mere'          => $Request->get('date_nais_mer') ?? '1990-01-01', // 🔧 Non-NULLABLE : date par défaut
    ];

    // Création de l'employé
    $employe = Employe::create($data);

    if ($employe->save()) {
        // 🔧 Ajout de l'action dans le journal
        $this->logService->logAction(
            Auth::user()->id,
            $employe->id_nin,
            'Ajouter Infos Personnelles Employé',
            $this->logService->getMacAddress()
        );

        $dbniv = $niv;
        $dbn=$niv;
        $dbempdepart = Departement::all();
        $empdepart   = $dbempdepart;

        return view('addTemplate.travaill', compact('employe', 'dbniv', 'empdepart', 'dbn'));
    } else {
        return redirect()->back()->with('error', 'Échec de l’enregistrement. Veuillez réessayer.');
    }
}


    public function addToDep(Request $Request)
    {

        $Request->validate([
            'ID_NIN' => 'required|integer',
            'ID_P'   => 'required|integer|',
            'ID_D'   => 'required|integer',
            'ID_B'   => 'required|integer',
            'DatePV' => 'required|date',
        ]);
        // dd($Request);
        try {
            $test = DB::table('travails')->insert([
                'id_nin'            => $Request->get('ID_NIN'),
                'id_p'              => $Request->get('ID_P'),
                'id_sous_depart'    => $Request->get('ID_D'),
                'id_bureau'         => $Request->get('ID_B'),
                'date_installation' => $Request->get('DatePV'),
                'date_chang'        => Carbon::now(),
                'notation'          => 0,

            ]);

            //ajouter l'action dans table log
            $this->logService->logAction(
                Auth::user()->id,
                $Request->get('ID_NIN'),
                'Ajouter Employé Au Département',
                $this->logService->getMacAddress()
            );

        } catch (\Exception $e) {
            Log::error('Failed to insert user: ' . $e->getMessage());
        }
        return redirect()->route('Employe.create')->with('success', 'User created successfully!');
    }

    public function existToAdd($id)
    {
        //dd($id);
        $employe = Employe::where('id_nin', $id)->firstOrFail();
        $niv     = new Niveau();
        $dbniv   = $niv->SELECT('Nom_niv', 'Specialite', 'Specialite_ar', 'Nom_niv_ar')->distinct()->get();
        //dd($dbniv);
        $dbempdepart = new Departement();
        $empdepart   = $dbempdepart->get();
        if (app()->getLocale() == 'ar') {
//      dd(app()->getLocale());
        }

        return view('addTemplate.travaill', compact('employe', 'dbniv', 'empdepart'));
    }

//------------- add a appartient table

    public function existToAddApp(Request $Request)
    {
        $niv          = new Niveau();
   
        $bureau       = new Bureau();
        $Direction    = new Departement();
        $SDirection   = new Sous_departement();
        $dbbureau     = $bureau->get();
        $dbsdirection = $SDirection->get();
        $dbdirection  = $Direction->get();
        $idn          = $niv->ID_N;
        $post         = new Post();
        $dbpost       = $post->get();
        $id           = $Request->get('ID_NIN');
        // dd($id);
        $employe = Employe::where('id_nin', $id)->firstOrFail();

        $Appartient = Appartient::where('id_nin', $id)->get();
        if ($Appartient->count() > 0) {
            //----------------- send To next $etp for Donnée Administration ----------------------
            //  dd($Appartient);

            $post    = new Post();
            $dbpost  = $post->get();
            $employe = Employe::where('id_nin', $id)->firstOrFail();
            //   dd($employe);
            $dbempdepart = new Departement();
            $empdepart   = $dbempdepart->get();
            return view('addTemplate.admin', compact('employe', 'dbdirection', 'bureau', 'dbpost', 'dbsdirection', 'empdepart'));
        }
        //---------------- this for add to Level Education and his Diploma -------------------------
          //    dd( $niv);
        $Request->validate([
            'ID_NIN'  => 'required|integer',
            'ID_P'    => 'required|integer|',
            'Dip'     => 'required|string|',
            'Dip_ar'     => 'required|string|',
            'Spec'    => 'required|string|',
            'Spec_ar'    => 'required|string|',
            'DipDate' => 'required|date',
        ]);

        dd($Request->input('Dip_ar'));
        $niv = Niveau::create(
            [
            'Nom_niv' => $Request->input('Dip'),
            'Nom_niv_ar'=> $Request->input('Dip_ar'),
            'Specialite'=> $Request->input('Spec'),
            'Specialite_ar' => $Request->input('Spec_ar'),
            'Descriptif_niv'=>"",
            'Descriptif_niv_ar'=>"",
                        ]
          );
         
        $idn = $niv->id_niv;
        $Request->validate([
            'DipRef' => 'required|string',
        ]);
        $test = DB::table('appartients')->insert([
            'id_nin'   => $Request->get('ID_NIN'),
            'id_p'     => $Request->get('ID_P'),
            'id_niv'   => $idn,
            'id_appar' => $Request->get('DipRef'),
            'Date_op'  => $Request->get('DipDate'),
        ]);

        //ajouter l'action dans table log
        $this->logService->logAction(
            Auth::user()->id,
            $Request->get('ID_NIN'),
            'Ajouter Niveau Education Employé',
            $this->logService->getMacAddress()
        );
        $dbempdepart = new Departement();
        $empdepart   = $dbempdepart->get();
        return view('addTemplate.admin', compact('employe', 'dbbureau', 'dbsdirection', 'dbdirection', 'dbpost', 'empdepart'));

    }
    /*function existApp($id)
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
        dd(app()->getLocale());
    return view('addTemplate.admin',compact('employe','dbbureau','dbdirection','dbpost','dbsdirection','empdepart'));
  }*/
    public function GenDecision(Request $request)
    {
        // dd($request);
        $id_postsup = null;
        $request->validate([
            'ID_NIN'      => 'required|integer',
            'ID_P'        => 'required|integer|',
            'Dic'         => 'required|integer|',
            'SDic'        => 'required|integer|',
            'post'        => 'required|integer|',
            'PVDate'      => 'required|date',
            'PV_grad'     => 'required|string',
            'id_postsup'  => 'integer',
            'id_fonction' => 'string',

        ]);

        $travaill = new Travail([
            'date_chang'        => Carbon::now(),
            'date_installation' => $request->get('PVDate'),
            'notation'          => 0,
            'id_nin'            => $request->get('ID_NIN'),
            'id_sous_depart'    => $request->get('SDic'),
            'id_p'              => $request->get('ID_P'),
            'id_bureau'         => 5,
        ]);
        //dd($travaill);

        if (isset($travaill)) {
            $pvf = $request->get('pv_func');
            $pvc = $request->get('pv_postsup');
            $pvi = 'new';
            $pv  = $request->get('PV_grad');
            if (isset($pvc)) {
                $pvi = $pvc;
            } else {if (isset($pvf)) {
                $pvi = $pvf;
            }}
            if ($request->get('pv_postsup') > 0) {
                $id_postsup = $request->get('pv_postsup');
            }

            Occupe::create([
                'date_recrutement' => $request->get('RecDate'),
                'echellant'        => 0,
                'id_nin'           => $request->get('ID_NIN'),
                'id_p'             => $request->get('ID_P'),
                'ref_PV'           => $pv,
                'ref_base'         => $request->get('PV_grad'),
                'id_post'          => $request->get('post'),
                'id_postsup'       => $id_postsup,
                'id_fonction'      => $request->get('pv_func'),

            ]);
            $travaill->save();
            $this->logService->logAction(
                Auth::user()->id,
                $request->get('ID_NIN'),
                'Générer La Décision Employé',
                $this->logService->getMacAddress()
            );
            return redirect()->back()->with('message', "This is Success Message");
        } else {
            return redirect()->back()->with('message', "This is UnSuccess Message");
        }
    }
}
