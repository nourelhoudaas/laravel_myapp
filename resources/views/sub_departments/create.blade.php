@extends('base')

@section('title', 'Ajouter une Sous-direction')

<body>
    <!-- start section aside -->
    @include('./navbar.sidebar')
    <!-- end section aside -->

    <h1 class="app-page-title">{{ __('lang.AddSubDir') }}</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
          <!--  <h3 class="section-title">{{ __('lang.ajout_direc_ssdirec') }}</h3>-->
           <!-- <div class="section-intro">{{ __('lang.msg_ajout') }}</div>-->
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <div class="section-title"><h4>{{ __('lang.msg_ajout_ssdirec') }}</h4></div>
                <div class="app-card-body">
                    <form action="{{ route('app_store_sub_depart') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                      <!-- <div class="text-bg-light p-3">
                            <label for="id_sous_depart" class="fw-bold">{{ __('lang.IdSubDepart') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('id_sous_depart') is-invalid @enderror" id="id_sous_depart" name="id_sous_depart" value="{{ old('id_sous_depart') }}" required>
                            @error('id_sous_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>-->

                        <div class="text-bg-light p-3">
                            <label for="id_depart" class="fw-bold">{{ __('lang.nom_direc') }} <span class="text-danger">*</span></label>
                            <select class="form-control @error('id_depart') is-invalid @enderror" id="id_depart" name="id_depart" required>
                                <option value="">{{ __('lang.select_department') }}</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id_depart }}" {{ old('id_depart') == $department->id_depart ? 'selected' : '' }}>
                                        @if (app()->getLocale() == 'fr')
                                            {{ $department->Nom_depart }}
                                        @else
                                            {{ $department->Nom_depart_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('id_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Nom_sous_depart" class="fw-bold">{{ __('lang.nom_ss_direc') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Nom_sous_depart') is-invalid @enderror" id="Nom_sous_depart" name="Nom_sous_depart" value="{{ old('Nom_sous_depart') }}" required>
                            @error('Nom_sous_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Descriptif_sous_depart" class="fw-bold">{{ __('lang.discr_ss_direc') }}</label>
                            <input type="text" class="form-control @error('Descriptif_sous_depart') is-invalid @enderror" id="Descriptif_sous_depart" name="Descriptif_sous_depart" value="{{ old('Descriptif_sous_depart') }}">
                            @error('Descriptif_sous_depart')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Nom_sous_depart_ar" class="fw-bold">{{ __('lang.nom_ss_direc_ar') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Nom_sous_depart_ar') is-invalid @enderror" id="Nom_sous_depart_ar" name="Nom_sous_depart_ar" value="{{ old('Nom_sous_depart_ar') }}" required>
                            @error('Nom_sous_depart_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-bg-light p-3">
                            <label for="Descriptif_sous_depart_ar" class="fw-bold">{{ __('lang.discr_ss_direc_ar') }}</label>
                            <input type="text" class="form-control @error('Descriptif_sous_depart_ar') is-invalid @enderror" id="Descriptif_sous_depart_ar" name="Descriptif_sous_depart_ar" value="{{ old('Descriptif_sous_depart_ar') }}">
                            @error('Descriptif_sous_depart_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('lang.btn.enregistrer') }}</button>
                        <a href="{{ route('app_liste_sub_dir') }}" class="btn btn-secondary">{{ __('lang.cancel') }}</a>
                    </form>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div>
    </div><!--//row-->
