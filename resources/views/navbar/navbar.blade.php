<!-- resources/views/home.blade.php -->
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
            /* Contrôlez la hauteur de l'image */
            height: 100%; 
            /* Centre et échelle l'image */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-size: cover;
  background-position: center;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;   

  text-align: center;
        }

        .bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/navbar/images/2.jpeg') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.7; /* Ajustez cette valeur pour régler la transparence */
            z-index: -1;
        }

        .content {
            text-align: center;
            color: black;
            position: absolute;
            bottom: 300px; /* Ajustez cette valeur pour régler la distance par rapport au footer */
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap; /* Empêcher les retours à la ligne */
            
        }

        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }

        .btn-get-started {
            background-color: black; /* Vert */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;

            
}
        
    </style>
</head>
<body>

<div class="bg">
    <div class="content">
   
       
    </div>
    <div class="footer">
        <a href="{{ route('login') }}" class="btn-get-started">Get Started</a>
    </div>
</div>

</body>
</html>
