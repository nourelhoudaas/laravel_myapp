@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>
        <?php

         //connexion à la base de donnée
          include_once "connexion.php";
         //on récupère le id dans le lien
          $id = $_GET['id'];
          //requête pour afficher les infos d'un employé
          $req = mysqli_query($con , "SELECT * FROM Post WHERE id_post = $id_post");
          $row = mysqli_fetch_assoc($req);


       //vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           //extraction des informations envoyé dans des variables par la methode POST
           extract($_POST);
           //verifier que tous les champs ont été remplis
           if(isset($nom_post) && isset($Grade_post) && $nom_poste_ar){
               //requête de modification
               $req = mysqli_query($con, "UPDATE Post SET nom_post = '$nom_post' , Grade_post = '$Grade_post' , nom_poste_ar = '$nom_poste_ar' WHERE id_post = $id_post");
                if($req){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: poste.php");
                }else {//si non
                    $message = "poste non modifié";
                }

           }else {
               //si non
               $message = "Veuillez remplir tous les champs !";
           }
       }

    ?>

    <div class="form">
        <a href="poste.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier l'employé : <?=$row['nom_post']?> </h2>
        <p class="erreur_message">
           <?php
              if(isset($message)){
                  echo $message ;
              }
           ?>
        </p>
        <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded"  >
            <div class= "section-title"><h4> Modifier une Direction </h4></div>

            <div class="app-card-body" >

                    <form action="#" method="POST">
                    @csrf
                    @method('PUT')

                    <div class= "text-bg-light p-3">
                        <label for="setting-input-1" class="fw-bold">Nom du poste</label>
                        <input type="text" class="form-control" id="Nom_post" placeholder="Nom du poste" name="Nom_depart" value="{{$post->Nom_post}}" required >

                    </div>
                    <div class="text-bg-light p-3">
                        <label for="setting-input-2" class="fw-bold">Grade de poste</label>
                        <input type="text" class="form-control" id="Grade_post" placeholder="Grade de poste" name="Grade_post" value="{{$post->Grade_post}}" required>
                    </div>
                    <div class= "text-bg-light p-3">
                        <label for="setting-input-1" class="fw-bold">Nom du poste en arabe</label>
                        <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" value="{{$post->Nom_post_ar}}" required>
                    </div>

    </div>
</body>



                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

