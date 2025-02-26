<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=" {{csrf_token()}}">

    <title> {{ config('app.name') }} - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">

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

    {{-- le contenu des pages sera afficher ici--}}
    @yield('content')

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

    {{-- nos script js--}}
    @include('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let isGenerating = false;

        // Fonction pour afficher l'alerte personnalisée
        function showCustomAlert(message) {
            const alertBox = document.getElementById('custom-alert');
            const alertMessage = document.getElementById('custom-alert-message');
            const alertClose = document.getElementById('custom-alert-close');

            alertMessage.textContent = message;
            alertBox.style.display = 'flex';

            alertClose.onclick = function () {
                alertBox.style.display = 'none';
            };
        }

        // Fonction pour afficher la modale de saisie et retourner une Promise
        function showCustomInput() {
            return new Promise((resolve) => {
                const inputBox = document.getElementById('custom-input');
                const inputField = document.getElementById('custom-input-name');
                const inputSubmit = document.getElementById('custom-input-submit');
                const inputCancel = document.getElementById('custom-input-cancel');

                inputField.value = ''; // Réinitialiser le champ
                inputBox.style.display = 'flex';

                inputSubmit.onclick = function () {
                    const value = inputField.value.trim();
                    inputBox.style.display = 'none';
                    resolve(value || null); // Retourner la valeur ou null si vide
                };

                inputCancel.onclick = function () {
                    inputBox.style.display = 'none';
                    resolve(null); // Retourner null si annulé
                };
            });
        }

        function generatePdf(event, linkElement, url) {
            if (isGenerating) {
                console.log('generatePdf déjà en cours, appel ignoré');
                return;
            }
            isGenerating = true;
            event.preventDefault();

            console.log('Début de generatePdf avec URL :', url);

            const spinnerOverlay = document.createElement('div');
            spinnerOverlay.className = 'spinner-overlay';
            const spinner = document.createElement('span');
            spinner.className = 'spinner';
            spinnerOverlay.appendChild(spinner);
            document.body.appendChild(spinnerOverlay);

            linkElement.style.pointerEvents = 'none';
            linkElement.style.opacity = '0.6';

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    console.log('Réponse reçue :', response.status, response.statusText);
                    if (!response.ok) {
                        return response.json().then(data => {
                            if (response.status === 404) {
                                throw new Error(data.message || 'Employé non trouvé');
                            }
                            throw new Error(`Erreur HTTP ${response.status}: ${data.error || 'Erreur inconnue'}`);
                        });
                    }
                    const filename = response.headers.get('Content-Disposition')?.match(/filename="(.+)"/)?.[1] || 'attestation.pdf';
                    return response.blob().then(blob => ({ blob, filename }));
                })
                .then(({ blob, filename }) => {
                    console.log('PDF généré, nom du fichier :', filename);
                    const downloadUrl = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = downloadUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(downloadUrl);
                })
                .catch(error => {
                    console.error('Erreur dans generatePdf :', error.message);
                    showCustomAlert(error.message);
                })
                .finally(() => {
                    console.log('Fin de generatePdf, suppression du spinner');
                    if (document.body.contains(spinnerOverlay)) {
                        document.body.removeChild(spinnerOverlay);
                    }
                    linkElement.style.pointerEvents = 'auto';
                    linkElement.style.opacity = '1';
                    isGenerating = false;
                });
        }

        function generateAttestation(event, linkElement) {
            event.preventDefault();
            console.log('generateAttestation déclenché par clic sur:', linkElement);

            // Afficher la modale de saisie et attendre la réponse
            showCustomInput().then(empName => {
                if (empName) {
                    const url = '{{ route("app_export_attes", "") }}/' + encodeURIComponent(empName);
                    console.log('Appel de generatePdf avec URL:', url);
                    generatePdf(event, linkElement, url);
                } else {
                    showCustomAlert("Veuillez entrer un nom valide.");
                }
            });
        }

        // Pour la liste (par ID)
        function generateAttestationList(event, linkElement, url) {
            event.preventDefault();
            console.log('generateAttestationList déclenché par clic sur:', linkElement, 'avec URL:', url);
            generatePdf(event, linkElement, url);
        }

    </script>
    <script>
        var lng = '{{app()->getLocale()}}'
        console.log('lang' + lng);

    </script>
</body>



</html>