@extends('base')

@section('title', 'Liste des Sous-directions')

<body>
    <!-- start section aside -->
    @include('./navbar.sidebar')
    <!-- end section aside -->

    <main>
        <div class="title"><h1>{{ __('lang.msg_list_sub_direct') }}</h1></div>
        <div class="recent_order">
            <table class="styled-table" id="myTable">
                <thead>
                    <tr>
                        <th>{{ __('lang.id_sub_depart') }}</th>
                        <th>{{ __('lang.nom_sous_direct') }}</th>
                        <th>{{ __('lang.discr_ss_direc') }}</th>
                        <th>{{ __('lang.nom_ss_direc_ar') }}</th>
                        <th>{{ __('lang.discr_ss_direc_ar') }}</th>
                        <th>{{ __('lang.nom_direc') }}</th>
                        <th>{{ __('lang.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $locale = app()->getLocale();
                    @endphp

                    @forelse ($subDepartments as $index => $subDepartment)
                        <tr>
                            <td>{{ $subDepartment->id_sous_depart }}</td>
                            <td>
                                @if ($locale == 'fr')
                                   <a href="#" onclick="return false;">
                                    {{ $subDepartment->Nom_sous_depart }} </a>
                                @elseif ($locale == 'ar')
                                    <a href="#" onclick="return false;">
                                   {{ $subDepartment->Nom_sous_depart }} </a>
                                @endif
                            </td>
                            <td>{{ $subDepartment->Descriptif_sous_depart ?? '-' }}</td>
                            <td>{{ $subDepartment->Nom_sous_depart_ar }}</td>
                            <td>{{ $subDepartment->Descriptif_sous_depart_ar ?? '-' }}</td>
                            <td>
                                @if ($locale == 'fr')
                                    {{ $subDepartment->departement->Nom_depart ?? 'Non défini' }}
                                @else
                                    {{ $subDepartment->departement->Nom_depart_ar ?? 'غير محدد' }}
                                @endif
                            </td>
                            <td>
                                <!-- Bouton Modifier -->
                                <a href="{{ route('sub_depart.edit', $subDepartment->id_sous_depart) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <!-- Formulaire de suppression -->
                               <!-- <form action="{{ route('subdepartement.delete', $subDepartment->id_sous_depart) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                                </form>-->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ __('lang.no_sub_dir_found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <nav class="app-pagination">
                {{ $subDepartments->links() }}
            </nav>
        </div>
    </main>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(event) {
                event.preventDefault();
                Swal.fire({
                    title: "{{ __('lang.confirm_delete_title') }}",
                    text: "{{ __('lang.confirm_delete_text') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: "{{ __('lang.yes_delete') }}",
                    cancelButtonText: "{{ __('lang.cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            }
        </script>
    @endpush
