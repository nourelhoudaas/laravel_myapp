<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/navbar/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/navbar/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/navbar/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('assets/navbar/css/style.css')}}">

    <title>Website Menu #4</title>
  </head>
  <body>


    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>



      @include('navbar.navbar')

    <div class="hero" style="background-image: url('{{ asset('assets/navbar/images/trrnws.jpg') }}')"></div>
  


    <script src="{{asset('assets/navbar/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/navbar/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/navbar/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/navbar/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('assets/navbar/js/main.js')}}"></script>
  </body>
</html>