@php
    use Carbon\Carbon;
@endphp

@extends('base')

@section('title', 'Employees')

@section('content')


    <!-- <div id="loadingSpinner" class="spinner-overlay">
        <div class="spinner"></div>
    </div> -->
    <div>
        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->

        <!-- main section start -->
        <main>
            <div class="recent_order">
                <div class="title">
                    {{ __('lang.lst_emp') }}
                </div>
                <table class="styled-table" id='myTable'>

                    <thead>

                        <tr>
                            <th>
                                {{ __('lang.ID_p') }}
                            </th>

                            <th>
                                {{ __('lang.name') }}
                            </th>
                            <th>
                                {{ __('lang.surname') }}
                            </th>
                            <th>
                                {{ __('lang.age') }}
                            </th>
                            <th>
                                {{ __('lang.date_rec') }}
                            </th>
                            <th>
                                {{ __('lang.date_CF') }}
                            </th>
                            <th>
                                {{ __('lang.visa_CF') }}
                            </th>
                            <th>
                                {{ __('lang.post') }}
                            </th>
                            <th>{{ __('lang.postsup') }}

                            </th>
                            <th>{{ __('lang.fct') }}

                            </th>
                            <th>
                                {{ __('lang.dept') }}
                            </th>
                            <th>
                                {{ __('lang.sous_dept') }}
                            </th>
                            <th>
                                {{ __('lang.date_inst') }}
                            </th>
                            <th>{{ __('lang.attestation') }}</th> <!-- Nouvelle colonne -->


                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employe as $employe)
                                            @php
                                                $occupeIdNin = $employe->occupeIdNin;
                                                $travailByNin = $employe->travailByNin;

                                                $post = null;
                                                $travail = null;
                                                $sousDepartement = null;
                                                $departement = null;
                                                $postsup = null;
                                                $fonction = null;
                                                $occupe = null;

                                                if ($occupeIdNin && $occupeIdNin->isNotEmpty()) {
                                                    $occupe = $occupeIdNin->last();
                                                    if ($occupe) {
                                                        $post = $occupe->post ?? null;
                                                        $postsup = $occupe->postsup ?? null;
                                                        $fonction = $occupe->fonction ?? null;
                                                    }
                                                }

                                                if ($travailByNin && $travailByNin->isNotEmpty()) {
                                                    $travail = $travailByNin->last();
                                                    if ($travail) {
                                                        $sousDepartement = $travail->sous_departement ?? null;
                                                        if ($sousDepartement) {
                                                            $departement = $sousDepartement->departement ?? null;
                                                        }
                                                    }
                                                }

                                                $locale = app()->getLocale();
                                            @endphp
                                            <tr>
                                                <td>{{ $employe->id_emp }}</td>
                                                <td>
                                                    <a href="{{ route('BioTemplate.detail', ['id' => $employe->id_nin]) }}">
                                                        @if ($locale == 'fr')
                                                            {{ $employe->Nom_emp }}
                                                        @elseif ($locale == 'ar')
                                                            {{ $employe->Nom_ar_emp }}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($locale == 'fr')
                                                        {{ $employe->Prenom_emp }}
                                                    @elseif ($locale == 'ar')
                                                        {{ $employe->Prenom_ar_emp }}
                                                    @endif
                                                </td>
                                                <td>{{ Carbon::parse($employe->Date_nais)->age }}</td>
                                                <td>{{ $occupe->date_recrutement ?? '-' }}</td>
                                                <td>{{ $occupe->date_CF ?? '-' }}</td>
                                                <td>{{ $occupe->visa_CF ?? '-' }}</td>
                                                <td>
                                                    @if ($locale == 'fr')
                                                        {{ $post->Nom_post ?? '-' }}
                                                    @elseif ($locale == 'ar')
                                                        {{ $post->Nom_post_ar ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($locale == 'fr')
                                                        {{ $postsup->Nom_postsup ?? '-' }}
                                                    @elseif ($locale == 'ar')
                                                        {{ $postsup->Nom_postsup_ar ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($locale == 'fr')
                                                        {{ $fonction->Nom_fonction ?? '-' }}
                                                    @elseif ($locale == 'ar')
                                                        {{ $fonction->Nom_fonction_ar ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($locale == 'fr')
                                                        {{ $departement->Nom_depart ?? '-' }}
                                                    @elseif ($locale == 'ar')
                                                        {{ $departement->Nom_depart_ar ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($locale == 'fr')
                                                        {{ $sousDepartement->Nom_sous_depart ?? '-' }}
                                                    @elseif ($locale == 'ar')
                                                        {{ $sousDepartement->Nom_sous_depart_ar ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>{{ $travail->date_installation ?? '-' }}</td>
                                                <!-- Nouvelle colonne pour le bouton Attestation -->
                                                <td>
                                                    <button class=" attestation-btn"
                                                        onclick="generateAttestationList(event, this, '{{ route('app_export_attesList', parameters: $employe->id_emp) }}')">
                                                        <i class='bx bxs-file'></i>
                                                        <span class="spinner" style="display: none;"></span>
                                                    </button>
                                                </td>
                                            </tr>
                        @endforeach
                        </>
                </table>

                {{-- <div class="pagination">
                    {{ $paginator->links() }}
                </div> --}}

            </div>

        </main>


    </div>
    <script>
        $(document).ready(function () {
            var ts = $(".small").text()
            console.log('testing' + ts)
        })
    </script>
<!-- Script pour gérer la génération de l'attestation -->
 <script>
    function generateAttestation(event, linkElement, url) {
        event.preventDefault();

        const spinner = document.createElement('span');
        spinner.className = 'spinner';
        linkElement.appendChild(spinner);
        
        linkElement.style.pointerEvents = 'none';
        linkElement.style.opacity = '0.6';

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
            // Récupérer le nom du fichier depuis l'en-tête Content-Disposition si disponible
            const filename = response.headers.get('Content-Disposition')?.match(/filename="(.+)"/)?.[1] || 'attestation.pdf';
            return response.blob().then(blob => ({ blob, filename }));
            //console.log('filename '+filename);
        })
        .then(({ blob, filename }) => {
            const downloadUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = downloadUrl;
            console.log('filenamess '+filename);
            a.download = filename; // Utiliser le nom fourni par le serveur
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
            linkElement.removeChild(spinner);
            linkElement.style.pointerEvents = 'auto';
            linkElement.style.opacity = '1';
        });
    }
</script> 



@endsection