<?php

namespace App\Http\Controllers;
use App\Models\Departement;
use App\Models\post;

use Illuminate\Http\Request;

class PostesController extends Controller
{
    public function addposte()
    {
        $con = mysqli_connect("localhost","root","","personnels");
        //dd($con);
  if(!$con){
     echo "Vous n'êtes pas connecté à la base de donnée";
  }

    //vérifier que le bouton ajouter a bien été cliqué
    if(isset($_POST['button'])){
        //extraction des informations envoyé dans des variables par la methode POST
        extract($_POST);

        $Nom_post=$_POST['nom'];
        $Grade_post=$_POST['grade'];
        $Nom_post_ar=$_POST['nom_ar'];
        //verifier que tous les champs ont été remplis
        if(isset($Nom_post) && isset($Grade_post) &&isset( $Nom_post_ar)){
             //connexion à la base de donnée
          //   include_once "connexion.php";
             //requête d'ajout
            // dd($_POST['nom']);
             $req = mysqli_query($con , "INSERT INTO `posts`(`Nom_post`, `Grade_post`, `Nom_post_ar`) VALUES('$Nom_post', '$Grade_post','$Nom_post_ar')");
            // dd($req);
             if($req){//si la requête a été effectuée avec succès , on fait une redirection
                 header("location: poste.php");
             }else {//si non
                 $message = "Poste non ajouté";
             }

        }else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }
    $empdepart=Departement::get();
    $post= post::firstOrFail();
        return view('postes.poste',compact('post','empdepart'));
    }
    public function Listeposte()
    {

        $poste = post::paginate(5);
        $empdepart=Departement::get();

        $poste= post::get();
       // dd($post);
        return view('postes.poste',compact('poste','empdepart'));
    }

    //modifier poste
    public function editer($post)
    {
  $post= post::where('id_post',$post)->firstOrFail();
  $empdepart=Departement::get();

        return view('postes.modifier', compact('post','empdepart'));

    }

    public function delete($id_post)
    {


        $post=new post();
            $post->where('id_post', '=', $id_post)->delete();



        return redirect()->back()->with('success_message','poste Supprimé');

    }


}

