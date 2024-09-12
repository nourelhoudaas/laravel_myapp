<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Mon Application</title>
   <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bg {
            position: relative;
            height: 100vh;
            background-image: url('{{ asset('assets/navbar/images/trrnws.jpg') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .content {
            position: absolute;
            bottom: 20px; /* Aligne le texte en bas */
            right: 20px; /* Aligne le texte à droite */
            text-align: right;
            color: white; /* Couleur du texte */
            padding: 0; /* Pas de padding */
        }

        .content h1 {
            margin: 0;
            font-size: 1.2em; /* Taille du texte du titre */
            line-height: 1.2; /* Hauteur de ligne pour le titre */
        }

        .content h2 {
            margin: 10px 0 0; /* Espacement au-dessus du sous-titre */
            font-size: 1em; /* Taille du texte du sous-titre */
            line-height: 1.2; /* Hauteur de ligne pour le sous-titre */
        }

        .footer {
            margin-top: 20px; /* Espacement entre le texte et le bouton */
        }

        .btn-get-started {
            background-color: #003366; /* Bleu foncé */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 8px;
        }

        .section {
            height: 100vh; /* Hauteur de la section pour le défilement */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f4; /* Couleur de fond pour la section */
        }
    </style>
</head>

<body>


<div class="bg">
    <div class="content">
        <h1>République Algérienne Démocratique et Populaire</h1>
        <h2>Ministère de la Communication</h2>
        <div class="footer">
            <a href="{{ route('login') }}" class="btn-get-started">Commencer</a>
        </div>
    </div>
</div>
</body>
</html>
