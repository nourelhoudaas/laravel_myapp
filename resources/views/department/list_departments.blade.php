@extends('base')

@section('title', 'Employees')

@section('content')

       @php
   // Définir la langue depuis la session
    App::setLocale(Session::get('locale', 'fr'));

    // Récupérer la langue active
    $locale = App::getLocale();

    //dd($locale); // Affichera 'fr' ou 'ar' par exemple
//     Session::get('locale');
    
   // dd($locale); // Devrait afficher 'ar'
@endphp

<div class="department-list">
    @forelse($empdepart as $depart)
        <div class="department-item" data-dep-id="{{ $depart->id_depart }}" style="cursor: pointer;">
            @if (app()->getLocale() == 'fr')
                {{ $depart->Nom_depart }}
            @elseif (app()->getLocale() == 'ar')
                {{ $depart->Nom_depart_ar }}
            @endif
        </div>
    @empty
        <p>Aucun département trouvé.</p>
    @endforelse
</div>
@endsection 