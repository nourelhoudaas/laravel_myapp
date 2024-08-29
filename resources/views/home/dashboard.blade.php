@extends('base')

@section('title', 'Dashboard')

@section('content')

<style>
main .insightss {
    display: flex;
    flex-direction: column;
    gap: 1.6rem;
    
}

main .insightss .sales {
    background-color: var(--clr-white);
    padding: var(--card-padding);
    border-radius: var(--card-border-raduis);
    margin-top: 1rem;
    box-shadow: var(--box-shadow);
    transition: all .3s ease;
    text-align: center
}
main .insights .sales:hover{
    box-shadow: none;}

    main .insights > div.expenses span{
    background: var(--clr-danger);
}

main .insights > div.income span{
    background: var(--clr-success);
}
main .insightss > div span {
    background: coral;
    padding: 0.5rem; /* Fixed padding to make it consistent */
    border-radius: 50%;
    color: var(--clr-white);
    font-size: 2rem;
}

main .insightss > div .middle h1 {
    font-size: 1.6rem;
}

main .insightss h1, main .insightss h3, main .insightss p {
    color: var(--clr-dark);
}
</style>
    <body>

            <!-- main section start -->
            <main>
                @php
                $uid=auth()->id()
                @endphp
                @if(isset($uid))
                <h1>{{ __('lang.Tableau_de_Bord_de') }} {{Auth::user()->username }}</h1>
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

                    <!-- start Absence 
                    <div class="expenses">
                        <span class="material-symbols-outlined">trending_down</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Absence</h3>
                                <h1>0</h1>
                            </div>
                        </div>
                    </div-->
                    <!-- end Absence -->

                    <!-- start Presence >
                    <div class="income">
                        <span class="material-symbols-outlined">trending_up</span>
                        <div class="middle">
                            <div class="left">
                                <h3>Presence</h3>
                                <h1>{{ $totalEmployes }}</h1>
                            </div>
                        </div>
                    </div-->
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
    var langth_pr = '{{app()->getLocale()}}'
    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: deptlis, // Two labels
       
        datasets: [
            {
                label: lang == 'ar' ? 'النظري' : 'Théorique',  // Dataset label
                data: [20, 20], // Data for the two labels
                backgroundColor: 'rgba(0, 147, 0, 0.8)', // Bar color
                borderColor: 'rgba(0, 255, 0, 1)', // Bar border color
                borderWidth: 1
            },
            {
                label: lang == 'ar' ? 'المتوقع' : 'Prévu', // Second Dataset label
                data: nbrem, // Data for the two labels
                backgroundColor: 'rgba(0, 55, 255, 0.72)', // Bar color
                borderColor: 'rgba(153, 102, 255, 1)', // Bar border color
                borderWidth: 1
            }
        ]
    },
    options: {
                responsive: true,
                maintainAspectRatio: false,
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
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
    });
</script>

@endsection
