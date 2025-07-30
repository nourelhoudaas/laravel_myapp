<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/lib/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/main/user/user.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('assets/app.js') }}"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}



<script>

    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#CngTable')) {
            $('#CngTable').DataTable().destroy();
        }

        let lang = "{{ app()->getLocale() }}";
        let oLanguage = {};

        if (lang === 'ar') {
            oLanguage = {
                info: 'عرض الصفحة _PAGE_ من _PAGES_',
                infoEmpty: 'لا توجد سجلات متاحة',
                infoFiltered: '',
                lengthMenu: 'عرض _MENU_ سجلات لكل صفحة',
                zeroRecords: 'لم يتم العثور على شيء - عذراً',
                emptyTable: 'لا توجد بيانات في الجدول',
                search: 'بحث: ',
                oPaginate: {
                    sNext: '<span class="pagination-fa"><i class="fa fa-chevron-left"></i></span><span class="pagination-default"></span>',
                    sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-right"></i></span><span class="pagination-default"></span>'
                }
            };
        } else if (lang === 'fr') {
            oLanguage = {
                info: 'Affichage de la page _PAGE_ sur _PAGES_',
                infoEmpty: 'Aucun enregistrement disponible',
                infoFiltered: '',
                emptyTable: 'Aucune donnée disponible dans le tableau',
                lengthMenu: 'Afficher _MENU_ enregistrements par page',
                zeroRecords: 'Rien trouvé - désolé',
                search: 'Recherche: ',
                oPaginate: {
                    sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                    sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                }
            };
        }


        $('#CngTable').DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            pagingType: "simple",
            language: oLanguage,

        });
    });
</script>

<script>
    /*==================== SHOW NAVBAR ====================*/
    const showMenu = (headerToggle, navbarId) => {
        const toggleBtn = document.getElementById(headerToggle),
            nav = document.getElementById(navbarId)

        // Validate that variables exist
        if (headerToggle && navbarId) {
            toggleBtn.addEventListener('click', () => {
                // We add the show-menu class to the div tag with the nav__menu class
                nav.classList.toggle('show-menu')
                // change icon
                toggleBtn.classList.toggle('bx-x')
            })
        }
    }
    showMenu('header-toggle', 'navbar')

    /*==================== LINK ACTIVE ====================*/
    const linkColor = document.querySelectorAll('.nav__link')

    function colorLink() {
        linkColor.forEach(l => l.classList.remove('active'))
        this.classList.add('active')
    }

    linkColor.forEach(l => l.addEventListener('click', colorLink))
</script>

{{-- /*=======================================DATATABLE===============================================*/ --}}
<script>

    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#myTable')) {
            $('#myTable').DataTable().destroy();
        }

        let lang = "{{ app()->getLocale() }}";
        let oLanguage = {};

        if (lang === 'ar') {
            oLanguage = {
                info: 'عرض الصفحة _PAGE_ من _PAGES_',
                infoEmpty: 'لا توجد سجلات متاحة',
                infoFiltered: '',
                lengthMenu: 'عرض _MENU_ سجلات لكل صفحة',
                zeroRecords: 'لم يتم العثور على شيء - عذراً',
                emptyTable: 'لا توجد بيانات في الجدول',
                search: 'بحث: ',
                oPaginate: {
                    sNext: '<span class="pagination-fa"><i class="fa fa-chevron-left"></i></span><span class="pagination-default"></span>',
                    sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-right"></i></span><span class="pagination-default"></span>'
                }
            };
        } else if (lang === 'fr') {
            oLanguage = {
                info: 'Affichage de la page _PAGE_ sur _PAGES_',
                infoEmpty: 'Aucun enregistrement disponible',
                infoFiltered: '',
                lengthMenu: 'Afficher _MENU_ enregistrements par page',
                zeroRecords: 'Rien trouvé - désolé',
                search: 'Recherche: ',
                emptyTable: 'Aucune donnée disponible dans le tableau',
                oPaginate: {
                    sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                    sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                }
            };
        }


        $('#myTable').DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            pagingType: "simple",
            language: oLanguage,

        });
    });
</script>

<script>

    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#AbsTable')) {
            $('#AbsTable').DataTable().destroy();
        }

        let lang = "{{ app()->getLocale() }}";
        let oLanguage = {};

        if (lang === 'ar') {
            oLanguage = {
                info: 'عرض الصفحة _PAGE_ من _PAGES_',
                infoEmpty: 'لا توجد سجلات متاحة',
                infoFiltered: '',
                lengthMenu: 'عرض _MENU_ سجلات لكل صفحة',
                zeroRecords: 'لم يتم العثور على شيء - عذراً',
                emptyTable: 'لا توجد بيانات في الجدول',
                search: 'بحث: ',
                oPaginate: {
                    sNext: '<span class="pagination-fa"><i class="fa fa-chevron-left"></i></span><span class="pagination-default"></span>',
                    sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-right"></i></span><span class="pagination-default"></span>'
                }
            };
        } else if (lang === 'fr') {
            oLanguage = {
                info: 'Affichage de la page _PAGE_ sur _PAGES_',
                infoEmpty: 'Aucun enregistrement disponible',
                infoFiltered: '',
                emptyTable: 'Aucune donnée disponible dans le tableau',
                lengthMenu: 'Afficher _MENU_ enregistrements par page',
                zeroRecords: 'Rien trouvé - désolé',
                search: 'Recherche: ',
                oPaginate: {
                    sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                    sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                }
            };
        }


        $('#AbsTable').DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            pagingType: "simple",
            language: oLanguage,

        });
    });
</script>


<script>
    function absTabel(reponse) {
        $(document).ready(function () {
            if ($.fn.DataTable.isDataTable('#AbsempTable')) {
                $('#AbsempTable').DataTable().destroy();
            }

            let lang = "{{ app()->getLocale() }}";
            let oLanguage = {};
            if (lang === 'ar') {
                columnshead = [{ 'data': 'id_nin' }, { 'data': 'date_abs' }, { 'data': 'heure_abs' }, { 'data': 'statut_ar' }]
                // columnshead =[{'data':'رقم'},{'data':'date_abs'},{'data':'heure_abs'},{'data':'statut'}]
                oLanguage = {
                    info: 'عرض الصفحة _PAGE_ من _PAGES_',
                    infoEmpty: 'لا توجد سجلات للغيابات متاحة',
                    infoFiltered: '',
                    lengthMenu: 'عرض _MENU_ سجلات لكل صفحة',
                    zeroRecords: 'لم يتم العثور على شيء - عذراً',
                    emptyTable: 'لا توجد بيانات في الجدول',
                    search: 'بحث: ',
                    oPaginate: {
                        sNext: '<span class="pagination-fa"><i class="fa fa-chevron-left"></i></span><span class="pagination-default"></span>',
                        sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-right"></i></span><span class="pagination-default"></span>'
                    }
                };
            } else if (lang === 'fr') {
                columnshead = [{ 'data': 'id_nin' }, { 'data': 'date_abs' }, { 'data': 'heure_abs' }, { 'data': 'statut' }]

                oLanguage = {
                    //     columnshead =[{'data':'Numero'},{'data':'Date d\'bsence'},{'data':'Heure d\'bsence'},{'data':'Motif de l\'absence'}]
                    info: 'Affichage de la page _PAGE_ sur _PAGES_',
                    infoEmpty: 'Aucun enregistrement disponible',
                    infoFiltered: '',
                    emptyTable: 'Aucune donnée d`absence disponible dans le tableau',
                    lengthMenu: 'Afficher _MENU_ enregistrements par page',
                    zeroRecords: 'Rien trouvé - désolé',
                    search: 'Recherche: ',
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                };
            }


            $('#AbsempTable').DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                pagingType: "simple",
                data: reponse,
                columns: columnshead,
                language: oLanguage,
                "rowCallback": function (row, data, index) {
                    // Add row number to the first column (index 0)
                    $('td:eq(0)', row).html(index + 1);
                    // Check if 'statut' is "justifier"
                    if (data.statut === 'justifier' || data.statut_ar === 'مبرر') {
                        $(row).css('cursor', 'pointer'); // Change cursor to pointer to indicate it's clickable

                        // Make the entire row clickable
                        $(row).on('click', function () {
                            console.log('file ' + data.id_fichier)
                            window.location.href = '/Employe/read_just/' + data.id_fichier; // Redirige vers une URL basée sur id_nin
                        });


                    } else {
                        // If statut is not 'justifier', do nothing or add specific behavior
                        $(row).css('cursor', 'not-allowed'); // Change cursor to indicate it's not clickable
                        //$('td:eq(3)', row).html('Non justifier'); // Indicate 'Non justifier' in the 'statut' column
                    }
                }

            });
        });
    }
</script>
<!-- base -->
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
            if (empName) { // Si un nom est saisi et validé
                const url = '{{ route("app_export_attes", "") }}/' + encodeURIComponent(empName);
                console.log('Appel de generatePdf avec URL:', url);
                generatePdf(event, linkElement, url);
            }
            // Si "Annuler" ou champ vide, ne rien faire (pas d'alerte)
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

<script>

    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#myTable_depart')) {
            $('#myTable_depart').DataTable().destroy();
        }

        let lang = "{{ app()->getLocale() }}";
        let oLanguage = {};

        if (lang === 'ar') {
            oLanguage = {
                info: 'عرض الصفحة _PAGE_ من _PAGES_',
                infoEmpty: 'لا توجد سجلات متاحة',
                infoFiltered: '',
                lengthMenu: 'عرض _MENU_ سجلات لكل صفحة',
                zeroRecords: 'لم يتم العثور على شيء - عذراً',
                emptyTable: 'لا توجد بيانات في الجدول',
                search: 'بحث: ',
                oPaginate: {
                    sNext: '<span class="pagination-fa"><i class="fa fa-chevron-left"></i></span><span class="pagination-default"></span>',
                    sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-right"></i></span><span class="pagination-default"></span>'
                }
            };
        } else if (lang === 'fr') {
            oLanguage = {
                info: 'Affichage de la page _PAGE_ sur _PAGES_',
                infoEmpty: 'Aucun enregistrement disponible',
                infoFiltered: '',
                lengthMenu: 'Afficher _MENU_ enregistrements par page',
                zeroRecords: 'Rien trouvé - désolé',
                search: 'Recherche: ',
                emptyTable: 'Aucune donnée disponible dans le tableau',
                oPaginate: {
                    sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                    sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                }
            };
        }


        $('#myTable_depart').DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            pagingType: "simple",
            language: oLanguage,

        });
    });
</script>


