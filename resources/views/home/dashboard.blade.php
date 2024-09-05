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
                $uid=auth()->id()
                @endphp
                @if(isset($uid))
                <h1>{{ __('lang.dashboard') }} de {{Auth::user()->username }}</h1>
                @else
                <h1>{{ __('lang.TableaudebordsansuserId') }}</h1>
                @endif

                <div class="insightss">
                    <!-- start Employees -->
                    <div class="sales">
                        <span class="material-symbols-outlined">groups</span>
                        <div class="middle">
                            <div class="left">
                                <h3>{{ __('lang.nbr_all_users') }}</h3>
                                <h1>{{ $totalEmployes}}</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Employees -->
                </div>



                {{-- chart --}}
                <div class="graphBox">
                    <div class="box">
                        <canvas id="myChart" ></canvas>
                    </div>
                    <div class="box2">
                        <canvas id="situationChart" ></canvas>
                    </div>
                    <div class="box3">
                        <canvas id="genderChart" ></canvas>
                        <div class="chart-label" id="chartLabel"></div>
                    </div>

                </div>
            </main>
            <!-- end main -->
        </div>
    </body>


{{-- chartt1 --}}




<script>
    var dept=@json($empdept);
   var lang='{{app()->getLocale()}}'
   var deptlis=[];
   var nbrem=[]
    dept.forEach(element => {
        if(lang =='ar')
        {
            deptlis.push(element.Nom_depart_ar)
            console.log(''+element.Nom_depart_ar)
        }
        else
        {

            deptlis.push(element.Nom_depart)
            console.log(''+element.Nom_depart)
        }
        nbrem.push(element.nbremp)
    });

    var langth_pr = '{{app()->getLocale()}}';
    var nbr_emp_depart;
    var nbr_emp;
    var situ_emp;


    if (langth_pr == 'ar') {
        nbr_emp_depart = 'توزيع الموظفين في كل مديرية';
        nbr_emp = 'عدد الموظفين';
        situ_emp = 'توزيع الموظفين حسب الحالة العائلية';
        sexe='توزيع الموظفين حسب الجنس';



    } else {
        nbr_emp_depart = 'Répartition des employés pour chaque département';
        nbr_emp = 'Nombre d\'employés';
        situ_emp = 'Répartition des Employés par Situation Familiale';
        sexe='Répartition des Employés par Sexe';

    }


const ctx = document.getElementById('myChart');
    console.log(nbrem)
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels:deptlis,
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
        'Homme': 'رجل',
        'Femme': 'امرأة'
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
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'
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
