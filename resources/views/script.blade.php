
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/lib/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets/main/user/user.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('assets/app.js') }}"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

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

$(document).ready(function() {
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
                sPrevious : '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
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

    $(document).ready(function() {
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
                    sPrevious : '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
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
    function absTabel(reponse){
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#AbsempTable')) {
                    $('#AbsempTable').DataTable().destroy();
                }

        let lang = "{{ app()->getLocale() }}";
        let oLanguage = {};
        columnshead =[{'data':'id_nin'},{'data':'date_abs'},{'data':'heure_abs'},{'data':'statut'}]  
        if (lang === 'ar') {
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
                    sPrevious : '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                }
            };
        }


        $('#AbsempTable').DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            pagingType: "simple",
            data:reponse,
            columns:columnshead,
            language: oLanguage,
            "rowCallback": function(row, data, index) {
            // Add row number to the first column (index 0)
            $('td:eq(0)', row).html(index + 1);
        }

        });
    });}
    </script>

<script>

    $(document).ready(function() {
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
                    sPrevious : '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
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
