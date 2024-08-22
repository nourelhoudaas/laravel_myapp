
@extends('base')

@section('title', 'poste')
<body>

 <!-- start section aside -->
 @include('./navbar.sidebar')
 <!-- end section aside -->
    <h1>Ajouter un employé</h1>

    <form action="{{ route('poste.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom"> nom de poste:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Grade de poste:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="prenom">poste en arabe:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>



        <!-- Ajoutez les autres champs du formulaire -->
        <style>
            .btn-primary {
                color: #000;
            }
        </style>
        <button type="submit" class="btn btn-primary">Ajouter le poste</button>
    </form>
    <a href="{{ route('liste_post') }}" class="btn btn-secondary">Retour</a>

@endsection
