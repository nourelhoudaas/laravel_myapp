@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Attestation de Travail</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #333;
            margin: 40px;
            font-size: 14px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 150px;
            margin-bottom: 15px;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            text-transform: uppercase;
            margin: 0;
        }
        .content p {
            margin: 10px 0;
        }
        .content strong {
            color: #138827; /* Vert pour les titres */
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        @if (file_exists(public_path('assets/main/img/logo_ministere.png')))
            <img src="{{ public_path('assets/main/img/logo_ministere.png') }}" alt="Logo Ministère">
        @else
            <p>Ministère de la Communication</p>
        @endif
        <h1>Attestation de Travail</h1>
    </div>

    <div class="content">
        <p>Nous soussignés, Ministère de la Communication, attestons que :</p>
        <p>
            <strong>Nom :</strong> 
            @if (app()->getLocale() == 'fr')
                {{ $employe->Nom_emp ?? '-' }}
            @else
                {{ $employe->Nom_ar_emp ?? '-' }}
            @endif
        </p>
        <p>
            <strong>Prénom :</strong> 
            @if (app()->getLocale() == 'fr')
                {{ $employe->Prenom_emp ?? '-' }}
            @else
                {{ $employe->Prenom_ar_emp ?? '-' }}
            @endif
        </p>
        <p>
            <strong>Fonction :</strong> 
            @if ($employe->occupeIdNin && $employe->occupeIdNin->isNotEmpty() && $employe->occupeIdNin->last()->fonction)
                @if (app()->getLocale() == 'fr')
                    {{ $employe->occupeIdNin->last()->fonction->Nom_fonction ?? '-' }}
                @else
                    {{ $employe->occupeIdNin->last()->fonction->Nom_fonction_ar ?? '-' }}
                @endif
            @else
                -
            @endif
        </p>
        <p>
            <strong>Date de recrutement :</strong> 
            @if ($employe->occupeIdNin && $employe->occupeIdNin->isNotEmpty() && $employe->occupeIdNin->last()->date_recrutement)
                {{ Carbon::parse($employe->occupeIdNin->last()->date_recrutement)->format('d/m/Y') }}
            @else
                -
            @endif
        </p>
        <p>
            Est employé(e) au sein de notre institution depuis le 
            <strong>
                @if ($employe->travailByNin && $employe->travailByNin->isNotEmpty() && $employe->travailByNin->last()->date_installation)
                    {{ Carbon::parse($employe->travailByNin->last()->date_installation)->format('d/m/Y') }}
                @else
                    -
                @endif
            </strong>.
        </p>
        <p>
            Cette attestation est délivrée à l'intéressé(e) pour servir et valoir ce que de droit.
        </p>
        <p>
            Fait à [Ville], le {{ Carbon::now()->format('d/m/Y') }}
        </p>
    </div>

    <div class="signature">
        <p>Le Responsable des Ressources Humaines</p>
        <p>[Nom du Responsable]</p>
    </div>

    <div class="footer">
        <p>Ministère de la Communication</p>
    </div>
</body>
</html>