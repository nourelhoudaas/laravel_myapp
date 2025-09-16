document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM entièrement chargé');

    // Fonction générique pour gérer la génération du PDF
    function handleExport(route, spinnerId, buttonId, fileName) {
        // Afficher le spinner
        document.getElementById(spinnerId).style.display = 'inline-block';
        // Désactiver le bouton
        document.getElementById(buttonId).disabled = true;

        // Envoyer une requête à la route pour générer le PDF
        fetch(route, {
            method: 'GET',
        })
        .then(response => response.blob())
        .then(blob => {
            // Créer un lien pour télécharger le PDF
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = fileName; // Utiliser le nom de fichier personnalisé
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);

            // Masquer le spinner et réactiver le bouton
            document.getElementById(spinnerId).style.display = 'none';
            document.getElementById(buttonId).disabled = false;
        })
        .catch(error => {
            console.error('Erreur lors de la génération du PDF :', error);
            // Masquer le spinner et réactiver le bouton en cas d'erreur
            document.getElementById(spinnerId).style.display = 'none';
            document.getElementById(buttonId).disabled = false;
        });
    }

    // Associer les boutons à leurs routes respectives avec des noms de fichiers personnalisés
    const exportEmplyBtn = document.getElementById('export-emply-btn');
    const exportCatgBtn = document.getElementById('export-catg-btn');
    const exportFncBtn = document.getElementById('export-fnc-btn');
    const exportCatBtn = document.getElementById('export-cat-btn');
     const exportHorsGradeBtn = document.getElementById('export-hors-grade-btn');

    if (exportEmplyBtn) {
        exportEmplyBtn.addEventListener('click', function() {
            console.log('Clic sur export-emply-btn');
            handleExport("{{ route('app_export_emply') }}", 'spinner-emply', 'export-emply-btn', 'liste_globale.pdf');
        });
    } else {
        console.log('Bouton export-emply-btn non trouvé');
    }

    if (exportCatgBtn) {
        exportCatgBtn.addEventListener('click', function() {
            console.log('Clic sur export-catg-btn');
            handleExport("{{ route('app_export_catg') }}", 'spinner-catg', 'export-catg-btn', 'Liste_des_employes_categorie.pdf');
        });
    }

    if (exportFncBtn) {
        exportFncBtn.addEventListener('click', function() {
            console.log('Clic sur export-fnc-btn');
            handleExport("{{ route('app_export_fnc') }}", 'spinner-fnc', 'export-fnc-btn', 'Liste_des_employes_fonction.pdf');
        });
    }

    if (exportCatBtn) {
        exportCatBtn.addEventListener('click', function() {
            console.log('Clic sur export-cat-btn');
            handleExport("{{ route('app_export_cat') }}", 'spinner-cat', 'export-cat-btn', 'Liste_des_employes_contrat_actuel.pdf');
        });
    }
           

    if (exportHorsGradeBtn) {
        exportHorsGradeBtn.addEventListener('click', function() {
            console.log('Clic sur export-hors-grade-btn');
            handleExport("{{ route('app_export_hors_grade') }}", 'spinner-hors-grade', 'export-hors-grade-btn', 'Liste des employés par grade 0-5.pdf');
        });
    } else {
        console.log('Bouton export-hors-grade-btn non trouvé');
    }
});