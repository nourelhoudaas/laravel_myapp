<?php

namespace App\Http\Controllers;
use App\Models\Departement;
use App\Models\post;

use Illuminate\Http\Request;

class PostesController extends Controller
{
    public function addposte()
    {
        $nom_p = post::where('id_post', $id_p)->value('Nom_poste');

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

