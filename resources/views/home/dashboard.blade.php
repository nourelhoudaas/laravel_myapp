@extends('base')

@section('title', 'Dashboard')

@section('content')
    <style>
        .chart-label {
            position: absolute;
            width: 100%;
            text-align: center;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
        }
    </style>

    <body>

        <!-- main section start -->
        <main>
            @php
                $uid = auth()->id()
            @endphp
            @if(isset($uid))
                <div class="title">
                    <h1>{{ __('lang.Tableau_de_Bord_de') }} {{Auth::user()->username }}</h1>
                </div>
            @else
                <div class="title">
                    <h1>{{ __('lang.TableaudebordsansuserId') }}</h1>
                </div>
            @endif

            <div class="insightss">
                <!-- start Employees -->
                <div class="sales">
                    <span class="material-symbols-outlined">groups</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.nbr_all_users') }}</h3>
                            <h1>{{ $totalEmployess}}</h1>
                        </div>
                    </div>
                </div>
                <!-- end Employees -->
            </div>
            <div class="insights">
                <!-- fonction superieur -->
                <div class="sales">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.FonctionSUP') }}</h3>
                            <h1>{{ $fs }}</h1>
                        </div>
                    </div>
                </div>
                <!-- end Employees -->

                <!-- post superieur -->
                <div class="income">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.PostSUP') }}</h3>
                            <h1>{{ $ps }}</h1>
                        </div>
                    </div>
                </div>
                <!-- end Absence -->

                <!-- corps commun -->
                <div class="expenses">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.CorpsCOMM') }}</h3>
                            <h1>{{ $cc }}</h1>
                        </div>
                    </div>
                </div>
                <!-- contrat actuel  -->
                <div class="contrat">
                    <span class="material-symbols-outlined">supervised_user_circle</span>
                    <div class="middle">
                        <div class="left">
                            <h3>{{ __('lang.ContraACT') }}</h3>
                            <h1>{{ $ca }}</h1>
                        </div>
                    </div>
                </div>
            </div>



            {{-- chart --}}
            <div class="graphBox">
                <div class="box">
                    <div class="chart-header">
                        <!-- <h3>{{ __('lang.rep_structure') }}</h3> -->
                        <button class="download-btn" onclick="downloadChart('myChart')">
                            {{ __('lang.imp') }}
                        </button>
                    </div>
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="box2">
                    <div class="chart-header">
                        <!-- <h3>{{ __('lang.rep_familiale') }}</h3> -->
                        <button class="download-btn" onclick="downloadChart('situationChart')">
                            {{ __('lang.imp') }}
                        </button>
                    </div>
                    <div class="chart-container">
                        <canvas class="canvas" id="situationChart"></canvas>
                    </div>
                </div>
                <div class="box3">
                    <div class="chart-header">
                        <!-- <h3>{{ __('lang.rep_sexe') }}</h3> -->
                        <button class="download-btn" onclick="downloadChart('genderChart')">
                            {{ __('lang.imp') }}
                        </button>
                    </div>
                    <div class="chart-container">
                        <canvas class="canvas" id="genderChart"></canvas>
                    </div>
                    <div class="chart-label" id="chartLabel"></div>
                </div>

            </div>
        </main>
        <!-- end main -->
        </div>
    </body>

    <!-- impression chart -->
    <script>
        /* ==============================================================
           1. FONCTION printChart() — DÉFINIE EN PREMIER !
           ============================================================== */
        /* ************* impression graphique ****************** */
        function printChart(canvasId) {
            const canvas = document.getElementById(canvasId);

            // Récupérer le titre depuis le <h3> le plus proche
            const titleElement = canvas.closest('.box, .box2, .box3').querySelector('.chart-header h3');
            const title = titleElement ? titleElement.innerText : 'Graphique';

            const printWin = window.open('', '', 'width=900,height=800');
            printWin.document.write(`
                            <!DOCTYPE html>
                            <html lang="{{ app()->getLocale() }}">
                            <head>
                                <meta charset="utf-8">
                                <title>${title}</title>
                                <style>
                                    body {font-family: Arial, sans-serif; margin: 20px; text-align: center;}
                                    h2 {color: #2c3e50; margin-bottom: 20px;}
                                    img {max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 8px;}
                                    .footer {margin-top: 30px; font-size: 12px; color: #7f8c8d;}
                                    @media print {
                                        body {margin: 10mm;}
                                        .footer {page-break-after: avoid;}
                                    }
                                </style>
                            </head>
                            <body>
                                <h2>${title}</h2>
                                <img src="${canvas.toDataURL('image/png')}" />
                                <div class="footer">
                                    Généré le ${new Date().toLocaleString('fr-FR')} — Système RH
                                </div>
                            </body>
                            </html>
                        `);
            printWin.document.close();
            printWin.focus();

            // Impression automatique
            printWin.onload = () => {
                setTimeout(() => {
                    printWin.print();
                    printWin.close();
                }, 500);
            };
        }

        /***************************************************** */
        /* ************* téléchargement graphique ****************** */
        function downloadChart(canvasId) {
            const canvas = document.getElementById(canvasId);
            const dataURL = canvas.toDataURL('image/png');

            // Nom court selon l'ID du canvas
            const filenames = {
                'myChart': 'repartition_structure',
                'situationChart': 'repartition_familiale',
                'genderChart': 'repartition_genre'
            };

            const baseName = filenames[canvasId] || 'graphique';

            // Date du jour : DD-MM-YYYY
            const today = new Date();
            const dateStr = String(today.getDate()).padStart(2, '0') + '-' +
                String(today.getMonth() + 1).padStart(2, '0') + '-' +
                today.getFullYear();

            // Nom final
            const filename = `${baseName}_${dateStr}.png`;

            // Téléchargement
            const link = document.createElement('a');
            link.href = dataURL;
            link.download = filename;
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        /* ==============================================================
           2. CRÉATION DES GRAPHIQUES (APRÈS la fonction printChart)
           ============================================================== */
        document.addEventListener('DOMContentLoaded', function () {
            const lang = '{{ app()->getLocale() }}';

            // --- Données départements ---
            const dept = @json($empdept);
            const deptlis = [];
            const nbrem = [];
            dept.forEach(el => {
                deptlis.push(lang === 'ar' ? el.Nom_depart_ar : el.Nom_depart);
                nbrem.push(el.nbremp);
            });

            // --- Titres traduits ---
            const titles = {
                dept: '{{ __('lang.rep_structure') }}',
                situ: '{{ __('lang.rep_familiale') }}',
                sexe: ' {{ __('lang.rep_sexe') }}',
                emp: lang === 'ar' ? 'عدد الموظفين' : 'Nombre de personnels'
            };

            // --- Graphique 1 : Départements ---
            const ctx1 = document.getElementById('myChart');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: deptlis,
                    datasets: [{
                        label: titles.emp,
                        data: nbrem,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { title: { display: true, text: titles.dept, position: 'top', font: { size: 16 } } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });

            // --- Graphique 2 : Situation familiale ---
            const situData = @json($data);
            const ctx2 = document.getElementById('situationChart');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: Object.keys(situData),
                    datasets: [{
                        label: titles.emp,
                        data: Object.values(situData),
                        backgroundColor: ['rgba(255,99,132,0.2)', 'rgba(54,162,235,0.2)', 'rgba(255,206,86,0.2)', 'rgba(75,192,192,0.2)'],
                        borderColor: ['rgba(255,99,132,1)', 'rgba(54,162,235,1)', 'rgba(255,206,86,1)', 'rgba(75,192,192,1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { title: { display: true, text: titles.situ, position: 'top', font: { size: 16 } } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                }
            });

            // --- Graphique 3 : Genre (Doughnut) ---
            const genderData = @json($dataGender);
            const trans = { fr: { Homme: 'Homme', Femme: 'Femme' }, ar: { Homme: 'ذكر', Femme: 'أنثى' } };
            const map = trans[lang] || trans.fr;
            const labels = Object.keys(genderData).map(k => map[k] || k);

            const ctx3 = document.getElementById('genderChart');
            new Chart(ctx3, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: titles.emp,
                        data: Object.values(genderData),
                        backgroundColor: ['rgba(54,162,235,0.2)', 'rgba(255,99,132,0.2)'],
                        borderColor: ['rgba(54,162,235,1)', 'rgba(255,99,132,1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: { title: { display: true, text: titles.sexe, position: 'top', font: { size: 16 } } }
                }
            });
        });
    </script>
    <!-- *******************FIN-IMP************************************* -->
    {{-- chartt1 --}}




    <script>
        var dept = @json($empdept);
        var lang = '{{app()->getLocale()}}'
        var deptlis = [];
        var nbrem = []
        dept.forEach(element => {
            if (lang == 'ar') {
                deptlis.push(element.Nom_depart_ar)
                console.log('' + element.Nom_depart_ar)
            }
            else {

                deptlis.push(element.Nom_depart)
                console.log('' + element.Nom_depart)
            }
            nbrem.push(element.nbremp)
        });

        var langth_pr = '{{app()->getLocale()}}';
        var nbr_emp_depart;
        var nbr_emp;
        var situ_emp;
        var sexe;

        if (langth_pr == 'ar') {
            nbr_emp = 'عدد الموظفين';
            /*nbr_emp_depart = 'توزيع الموظفين في كل مديرية';
            situ_emp = 'توزيع الموظفين حسب الحالة العائلية';
            sexe='توزيع الموظفين حسب الجنس';*/



        } else {
            nbr_emp = 'Nombre de personnels';
            /*nbr_emp_depart = 'Répartition des personnels par sturcture';
            situ_emp = 'Répartition des personnels par Situation Familiale';
            sexe='Répartition des personnels par Sexe';*/

        }


        const ctx = document.getElementById('myChart');
        console.log(nbrem)
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: deptlis,
                datasets: [{
                    label: nbr_emp,
                    data: nbrem,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            stepSize: 1, // Forcer les nombres entiers sur l'axe X

                        }
                    },

                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Éviter les valeurs décimales sur l'axe Y
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: nbr_emp_depart, // Le texte du titre
                        position: 'bottom', // Positionner le titre sous le graphique
                        padding: {
                            top: 10, // Ajouter un espace entre le graphique et le titre
                            bottom: -0
                        },
                        font: {
                            size: 16 // Taille de la police du titre
                        }
                    }
                }
            }

        });



        // Récupérer les données PHP dans JavaScript
        const situationData = @json($data);

        // Extraire les labels (situations familiales) et les données (nombre d'employés)
        const labels = Object.keys(situationData);
        const data = Object.values(situationData);

        // Créer le graphique circulaire avec Chart.js
        const ctx2 = document.getElementById('situationChart').getContext('2d');
        const situationChart = new Chart(ctx2, {
            type: 'bar', // Utiliser 'doughnut' pour un chart en forme de donut
            data: {
                labels: labels,
                datasets: [{
                    label: nbr_emp,
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            stepSize: 1, // Forcer les nombres entiers sur l'axe X

                        }
                    },

                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Éviter les valeurs décimales sur l'axe Y
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: situ_emp,
                        position: 'bottom',
                        padding: {
                            top: 10, // Ajouter un espace entre le graphique et le titre
                            bottom: -0
                        },
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
        //****************************************************************
        // Récupérer les données PHP dans JavaScript
        const genderData = @json($dataGender);

        // Passer la langue sélectionnée (exemple: 'fr' pour français, 'ar' pour arabe)
        const selectedLanguage = @json($lang);

        // Définir les traductions pour chaque langue
        const translations = {
            'fr': {
                'Homme': 'Homme',
                'Femme': 'Femme'
            },
            'ar': {
                'Homme': 'ذكر',
                'Femme': 'أنثى'
            }
        };

        // Extraire les labels (sexes) et les données (nombre d'employés)
        const labels2 = Object.keys(genderData);
        const data2 = Object.values(genderData);

        // Sélectionner les traductions en fonction de la langue
        const labelMapping = translations[selectedLanguage] || translations['fr'];

        // Log pour déboguer
        console.log(labelMapping);

        // Remapper les labels pour le graphique
        const translatedLabels2 = labels2.map(label => labelMapping[label] || label);

        // Créer le graphique doughnut avec Chart.js
        const ctx3 = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: translatedLabels2, // Utiliser les labels traduits ici
                datasets: [{
                    label: nbr_emp,
                    data: data2,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        display: true,
                        color: '#000',
                        formatter: (value, context) => {
                            // Afficher les labels traduits
                            return context.chart.data.labels[context.dataIndex];
                        },
                        font: {
                            weight: 'bold'
                        }
                    },
                    title: {
                        display: true,
                        text: sexe,
                        position: 'bottom',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    </script>

@endsection