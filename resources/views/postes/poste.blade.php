@extends('base')


@section('title', 'liste Postes')

@section('content')
<body>
    <?php
      //connexion à la base de données
  $con = mysqli_connect("localhost","root","","personnels");
  if(!$con){
     echo "Vous n'êtes pas connecté à la base de donnée";
  }
    //vérifier que le bouton ajouter a bien été cliqué
    if(isset($_POST['button'])){
        //extraction des informations envoyé dans des variables par la methode POST
        extract($_POST);
        //verifier que tous les champs ont été remplis
        if(isset($Nom_post) && isset($Grade_post) &&isset( $Nom_post_ar)){
             //connexion à la base de donnée
             include_once "connexion.php";
             //requête d'ajout
             $req = mysqli_query($con , "INSERT INTO posts VALUES(NULL, '$Nom_post', '$Grade_post','$Nom_post_ar')");
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

 ?>
 <div>
 <div class="form2">

     <h2>Ajouter un Poste</h2>
     <p class="erreur_message">
         <?php
         // si la variable message existe , affichons son contenu
         if(isset($message)){
             echo $message;
         }
         ?>

     </p>
     <form action="/postes/poste" method="POST">
        @csrf

         <label>Nom Poste</label>
         <input type="text" name="nom">
         <label>Grade poste</label>
         <input type="text" name="grade">
         <label>Nom arabe</label>
         <input type="text" name="nom_ar">
         <input type="submit" value="Ajouter" name="button">
     </form>
 </div>
    <div class="tabpost">


        <table id="tabpost">
            <thead>
            <tr >

                <th>Nom Poste</th>
                <th>Grade poste</th>
                <th>Nom arabe</th>
                <th>action</th>
            </tr>
        </thead>
            <?php



                //inclure la page de connexion
             //  include_once "connexion.php";
                //requête pour afficher la liste des ؛postes
                $req = mysqli_query($con , "SELECT * FROM posts");
                if(mysqli_num_rows($req) == 0){

                    echo "Il n'y a pas encore de poste ajouter !" ;

                }else {
                    //si non , affichons la liste
                  //
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>

                            <td><?=$row['Nom_post']?></td>
                            <td><?=$row['Grade_post']?></td>
                            <td><?=$row['Nom_post_ar']?></td>
                            <!--Nous alons mettre l'id de chaque employé dans ce lien -->
                            <td>
                                <style>
                                    .fa-edit {

                                        font-size:30px;
                                    }
                                </style>
                                <a href="{{route('poste.modifier',$id_post=$row['id_post'])}}"><i class="fa fa-edit" ></i></a>




                                    <style>
                                        .fa-trash {
                                            color: #e40b0b;
                                            font-size:30px;
                                        }
                                    </style>
                                    <a  href="{{route('post.delete',$id_post=$row['id_post'])}}" onclick="confirmation(event)" > <i class="fa fa-trash" aria-hidden="true"></i></a>
                                </form2>
                            </td>
                        </tr>
                        <?php


                }}
            ?>
<script type="text/javascript">
    function confirmation(ev){
        evpreventDefault();
        var urlToRedirect=ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title:"voulez-vous supprimé cette direction?",
            title:"etes vous sure ?",
            icon:"warning",
            buttons :true,
            dangerMode : true,
        })
        .then((willCancel)=>
    {
        if(willCancel)
    {
             window.location.href=urlToRedirect;
    }
    }
    )
    }
    </script>

        </table>




    </div>
</div>
</body>


        @endsection



