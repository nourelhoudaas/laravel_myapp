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
             $req = mysqli_query($con , "INSERT INTO posts VALUES('$Nom_post', '$Grade_post','$Nom_post_ar')");
             if($req){//si la requête a été effectuée avec succès , on fait une redirection
                 header("location: poste.php");
             }else {//si non
                 $message = "Poste non ajouté";
             }

        }else {

            $message = "Veuillez remplir tous les champs !";
        }
    }

 ?>
 <div>


    <div class="container2">
        <div class="recent_order">
            <h1 class="app-page-title">Liste des Postes</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
<div>

                <button class="btn btn-success newUser" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-plus-circle">Poste</i></button>

            </div>
            <table id='myDataTable' class="table">
            <thead>

            <tr >

                <th>Nom Poste</th>
                <th>Grade poste</th>
                <th>Nom arabe</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $poste)
                <tr>
                    <td>{{ $poste->Nom_post }}</td>
                    <td>{{ $poste->Grade_post }}</td>
                    <td>{{ $poste->Nom_post_ar }}</td>
                    <td>
                       <!-- ///postes/modifier/{{$poste->id_post}}-->
                       <a href="#"  data-bs-toggle="modal" data-bs-target="#readData"><i class="fa fa-edit"></i></a>
                     <!--  <a class="fa fa-edit" data-bs-toggle="modal" data-bs-target="readData"><i ></i></a>-->

                     <form action="#" method="POST" style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?')"
                            href="/post/{{$poste->id_post}}"> <i
                                class="fa fa-trash" aria-hidden="true"></i></a>
                    </form>

                    </td>
                </tr>
            @endforeach
        </tbody>



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
<div class="modal fade" id="userForm">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <style>
                .modal-header{

    background: #0d6efd;
    color: #fff;

}
            </style>

            <div class="modal-header">
                <h4 class="modal-title">Ajouter un Nouveau Poste</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('app_store_poste') }}"  method="POST">


                        @csrf


                    <div class="inputField">
                        <div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom du Poste </label>
                                <input type="text" class="form-control" id="Nom_post" placeholder="Nom de la Direction" name="Nom_post" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">Grede Poste</label>
                                <input type="text" class="form-control" id="Grade_post" placeholder="Discription de la direction" name="Grade_post" required>
                            </div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom du Poste en Arabe</label>
                                <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" required>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i></button>
                    </div>

                </form>

            </div>


        </div>
    </div>
</div>


</body>
   <!--Modal Form-->
   <div class="modal fade" id="readData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="#" id="myForm">



                    <div class="inputField">
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" name="" id="showName" disabled>
                        </div>
                        <div>
                            <label for="age">Age:</label>
                            <input type="number" name="" id="showAge" disabled>
                        </div>
                        <div>
                            <label for="city">City:</label>
                            <input type="text" name="" id="showCity" disabled>
                        </div>
                        <div>
                            <label for="email">E-mail:</label>
                            <input type="email" name="" id="showEmail" disabled>
                        </div>
                        <div>
                            <label for="phone">Number:</label>
                            <input type="text" name="" id="showPhone" minlength="11" maxlength="11" disabled>
                        </div>
                        <div>
                            <label for="post">Post:</label>
                            <input type="text" name="" id="showPost" disabled>
                        </div>
                        <div>
                            <label for="sDate">Start Date:</label>
                            <input type="date" name="" id="showsDate" disabled>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
 <!-- Option 1: Bootstrap Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 <script >
    var form = document.getElementById("myForm"),

    Name = document.getElementById("name"),
    grade = document.getElementById("grade"),
    name_ar = document.getElementById("nom_ar"),

    submitBtn = document.querySelector(".submit"),
    userInfo = document.getElementById("data"),
    modal = document.getElementById("userForm"),
    modal = document.getElementById("readData"),

    modalTitle = document.querySelector("#userForm .modal-title"),
    newUserBtn = document.querySelector(".newUser")


let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : []

let isEdit = false, editId
showInfo()

newUserBtn.addEventListener('click', ()=> {
    submitBtn.innerText = 'Submit',
    modalTitle.innerText = "Fill the Form"
    isEdit = false
    imgInput.src = "./image/Profile Icon.webp"
    form.reset()
})





function showInfo(){
    document.querySelectorAll('.employeeDetails').forEach(info => info.remove())
    getData.forEach((element, index) => {
        let createElement = `<tr class="employeeDetails">
            <td>${index+1}</td>

            <td>${Post.Name}</td>
            <td>${Post.grade}</td>
            <td>${Post.name_ar}</td>



            <td>
                <button class="btn btn-success" onclick="readInfo('${Post.Name}', '${Post.grade}', '${Post.name_ar}')" data-bs-toggle="modal" data-bs-target="#readData"><i class="bi bi-eye"></i></button>

                <button class="btn btn-primary" onclick="editInfo(${index}, '${Post.Name}', '${Post.grade}', '${Post.name_ar}')" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>

                <button class="btn btn-danger" onclick="deleteInfo(${index})"><i class="bi bi-trash"></i></button>

            </td>
        </tr>`

        userInfo.innerHTML += createElement
    })
}
showInfo()


function readInfo(name, grade, name_ar){
    document.querySelector('#showName').value = name,
    document.querySelector("#showgrade").value = grade,
    document.querySelector("#showanme_ar").value = name_ar,
}


function editInfo(index, name, grade, name_ar){
    isEdit = true
    editId = index
    userName.value = name
    grade.value = grade
    name_ar.value =name_ar


    submitBtn.innerText = "Update"
    modalTitle.innerText = "Update The Form"
}


function deleteInfo(index){
    if(confirm("Are you sure want to delete?")){
        getData.splice(index, 1)
        localStorage.setItem("userProfile", JSON.stringify(getData))
        showInfo()
    }
}


form.addEventListener('submit', (e)=> {
    e.preventDefault()

    const information = {
        picture: imgInput.src == undefined ? "./image/Profile Icon.webp" : imgInput.src,
        employeeName: userName.value,
        employeeAge: age.value,
        employeeCity: city.value,
        employeeEmail: email.value,
        employeePhone: phone.value,
        employeePost: post.value,
        startDate: sDate.value
    }

    if(!isEdit){
        getData.push(information)
    }
    else{
        isEdit = false
        getData[editId] = information
    }

    localStorage.setItem('userProfile', JSON.stringify(getData))

    submitBtn.innerText = "Submit"
    modalTitle.innerHTML = "Fill The Form"

    showInfo()

    form.reset()

    imgInput.src = "./image/Profile Icon.webp"

    // modal.style.display = "none"
    // document.querySelector(".modal-backdrop").remove()
})
 </script>




        @endsection
