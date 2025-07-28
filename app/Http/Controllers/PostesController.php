<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Post;


use Illuminate\Http\Request;

class PostesController extends Controller
{
    public function addposte()
    {
       // $id_p=post::get();
       //$nom_p = post::where('id_post', $id_p)->value('Nom_post');

    $empdepart=Departement::get();
   //$post= post::firstOrFail();
        return view('postes.add_poste',compact('empdepart'));
    }
    public function Listeposte()
    {


        $empdepart=Departement::get();
        $post = Post::get();


       // dd($post);
        return view('postes.poste',compact('post','empdepart'));
    }
    //modifier poste
    public function editer($nom)
    {
  $post= Post::where('id_post',$nom)->firstOrFail();
  $empdepart=Departement::get();
       // dd( $departement);
        return view('postes.modifier', compact('post','empdepart'));

    }



    public function delete($id_post)
    {
        $post=new Post();
            $post->where('id_post', '=', $id_post)->delete();



        return redirect()->back()->with('success_message','poste Supprimé');

    }
    public function store(Request $request)

    {

        $request->validate([
            'Nom_post'=>'required',
            'Grade_post'=>'required',
            'Nom_post_ar'=>'required',
    ]);

        Post::create($request->all());

       //return response()->json(['success'=>'sucess']);
        return redirect('/poste')->with('success', 'Poste ajouté avec succès.');
    }
    public function update(Request $request, $id)
    {

        $post= Post::where('id_post',$id)->update(['Nom_post'=>$request->input('Nom_post'),'Grade_post'=>$request->input('Grade_post'),
        'Nom_post_ar'=>$request->input('Nom_post_ar')]);




        return redirect('/poste')->with('success', 'Poste mis a jour!');;


    }

}

