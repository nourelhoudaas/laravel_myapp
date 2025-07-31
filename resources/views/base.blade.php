<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=" {{csrf_token()}}">

    <title> {{ config('app.name') }} - @yield('title')</title>

    
    @include('script')
    <!--========== BOX ICONS ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fonticons/fonticons@latest/css/fonticons.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">




</head>

<body>


    @guest
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        {{-- barre de navigation--}}

    @endguest


    @auth

        {{-- barre de navigation a gauche--}}
        @include('navbar.sidebar')


    @endauth

    {{--On inclus les messages d'alert--}}
    @include('alerts.alert-message')

    <!-- Modale pour l'alerte (déjà présente) -->
    <div id="custom-alert" class="custom-alert" style="display: none;">
        <div class="custom-alert-content">
            <p id="custom-alert-message"></p>
            <button id="custom-alert-close" class="custom-alert-button">OK</button>
        </div>
    </div>

    <!-- Nouvelle modale pour la saisie du nom -->
    <div id="custom-input" class="custom-input" style="display: none;">
        <div class="custom-input-content">
            <p>Entrez le nom de l'employé :</p>
            <input type="text" id="custom-input-name" class="custom-input-field" placeholder="Nom de l'employé">
            <div class="custom-input-buttons">
                <button id="custom-input-submit" class="custom-input-button">Valider</button>
                <button id="custom-input-cancel" class="custom-input-button custom-input-cancel">Annuler</button>
            </div>
        </div>
    </div>

    {{-- le contenu des pages sera afficher ici--}}
    @yield('content')


    {{-- nos script js--}}
    @include('script')

</body>



         @include('script')
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function generatePdf(event, linkElement, url) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Créer un élément spinner dynamiquement
        const spinner = document.createElement('span');
        spinner.className = 'spinner';
        
        // Ajouter le spinner après le texte du lien
        linkElement.appendChild(spinner);
        
        // Désactiver le lien pendant la génération
        linkElement.style.pointerEvents = 'none';
        linkElement.style.opacity = '0.6';

        // Faire la requête pour générer le PDF
        fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la génération du PDF');
            }
            return response.blob();
        })
        .then(blob => {
            // Créer un lien temporaire pour télécharger le PDF
            const downloadUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = downloadUrl;
            a.download = url.split('/').pop() + '.pdf'; // Nom du fichier basé sur l'URL
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(downloadUrl);
        })
        .catch(error => {
            console.error('Erreur :', error);
            alert('Une erreur est survenue lors de la génération du PDF.');
        })
        .finally(() => {
            // Supprimer le spinner et réactiver le lien
            linkElement.removeChild(spinner);
            linkElement.style.pointerEvents = 'auto';
            linkElement.style.opacity = '1';
        });
    }
</script>
    <script>
        var lng='{{app()->getLocale()}}'
        console.log('lang'+lng);

    </script>



</html>
