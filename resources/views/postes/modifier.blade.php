@extends('base')


@section('title', 'liste Postes')

@section('content')


<body>
    <?php

             //connexion à la base de donnée
  $con = mysqli_connect("localhost","root","","personnels");
  if(!$con){
     echo "Vous n'êtes pas connecté à la base de donnée";
  }
             //on récupère le id dans le lien
              $id = $_GET['id'];
              //requête pour afficher les infos d'un employé
              $req = mysqli_query($con , "SELECT * FROM posts WHERE id_post  = $id_post");
              $row = mysqli_fetch_assoc($req);


           //vérifier que le bouton ajouter a bien été cliqué
           if(isset($_POST['button'])){
               //extraction des informations envoyé dans des variables par la methode POST
               extract($_POST);
               //verifier que tous les champs ont été remplis
               if(isset($Nom_post) && isset($Grade_post) && $Nom_post_ar){
                   //requête de modification
                   $req = mysqli_query($con, "UPDATE posts SET Nom_post = '$Nom_post' , Grade_post = '$Grade_post' , Nom_post_ar = '$Nom_post_ar' WHERE id_post = $id_post");
                    if($req){//si la requête a été effectuée avec succès , on fait une redirection
                        header("location: poste.modifier");
                    }else {//si non
                        $message = "Poste non modifié";
                    }

               }else {
                   //si non
                   $message = "Veuillez remplir tous les champs !";
               }
           }

        ?>

        <div class="form">
            <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
            <h2>Modifier l'employé : <?=$row['nom']?> </h2>
            <p class="erreur_message">
               <?php
                  if(isset($message)){
                      echo $message ;
                  }
               ?>
            </p>
            <form action="" method="POST">
                <label>Nom</label>
                <input type="text" name="nom" value="<?=$row['nom']?>">
                <label>Prénom</label>
                <input type="text" name="prenom" value="<?=$row['prenom']?>">
                <label>âge</label>
                <input type="number" name="age" value="<?=$row['age']?>">
                <input type="submit" value="Modifier" name="button">
            </form>
        </div>
    </body>
