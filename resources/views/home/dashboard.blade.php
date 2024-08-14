@extends('base')

@section('title', 'Dashboard')

@section('content')

    <body>

            <!-- main section start -->
            <main>
                @php
                $uid=auth()->id()
                @endphp
                @if(isset($uid))
                <h1>Tableau de Bord de {{Auth::user()->username }}</h1>
                @else
                <h1>Dashboard without userId</h1>
                @endif

                <div class="insights">
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

                    <!-- start Absence -->
                    <div class="expenses">
                        <span class="material-symbols-outlined">trending_down</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Absence</h3>
                                <h1>0</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Absence -->

                    <!-- start Presence -->
                    <div class="income">
                        <span class="material-symbols-outlined">trending_up</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Presence</h3>
                                <h1>{{ $totalEmployes }}</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end Presence -->
                </div>

                {{-- chart --}}
                <div class="graphBox">
                    <div class="box">
                        <canvas id="myChart" ></canvas>
                    </div>
                    <div class="box">
                        <canvas id="myChart2" ></canvas>
                    </div>
                </div>
            </main>
            <!-- end main -->
        </div>
    </body>


{{-- chartt1 --}}
<script>
     
</script>
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
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: deptlis, // Two labels
        datasets: [
            {
                label: 'Theorique', // Dataset label
                data: [20, 20], // Data for the two labels
                backgroundColor: 'rgba(0, 147, 0, 0.8)', // Bar color
                borderColor: 'rgba(0, 255, 0, 1)', // Bar border color
                borderWidth: 1
            },
            {
                label: 'apprevu', // Second Dataset label
                data: nbrem, // Data for the two labels
                backgroundColor: 'rgba(0, 0, 255, 0.5)', // Bar color
                borderColor: 'rgba(153, 102, 255, 1)', // Bar border color
                borderWidth: 1
            }
        ]
    },
        options: {
           scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

/* chartt2*/

    const ctx2 = document.getElementById('myChart2');
    console.log(nbrem)
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels:deptlis,
            datasets: [{
                label: '# of Votes',
                data: nbrem,
                borderWidth: 1
            }]
        },
        options: {
           scales: {
                y: {
                    beginAtZero: true
                }
            }

        }
    });
</script>

@endsection
