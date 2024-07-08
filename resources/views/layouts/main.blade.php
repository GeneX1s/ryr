<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Roemah Yoga Rian</title>
  <meta name="description"
    content="The template is built for Sport Clubs, Health Clubs, Gyms, Fitness Centers, Personal Trainers and other sport">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

  <!-- All css here -->
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/3.11.2/modernizr.min.js"></script> --}}
  {{-- <link rel="stylesheet" href="css/shortcode/shortcodes.css"> <!-- Keep local as no CDN available --> --}}
  {{-- <link rel="stylesheet" href="style.css"> <!-- Keep local as it's custom --> --}}
  {{-- <link rel="stylesheet" href="css/responsive.css"> <!-- Keep local as no CDN available --> --}}

  
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/font-awesome.min.css">
  <link rel="stylesheet" href="../../css/shortcode/shortcodes.css">
  <link rel="stylesheet" href="../../css/slick.css">
  <link rel="stylesheet" href="../../style.css">
  <link rel="stylesheet" href="../../css/responsive.css">
  <script src="js/vendor/modernizr-3.11.2.min.js"></script>
  <style>
    .top {
        max-width: unset !important;
    }
    .slider-area {
        max-width: unset !important;
    }
    </style>
</head>

<body>
  @include('layouts.header')


  <div class="container">
    @yield('container')
    <style>
    .container, .container-md, .container-sm {
        max-width: unset !important;
    }
    </style>
    {{-- yield container supaya bisa dipanggil dari child class(page lain) --}}
  </div>
  <script src="js/vendor/jquery-3.6.0.min.js"></script>
  <script src="js/vendor/jquery-migrate-3.3.2.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.meanmenu.js"></script>
  <script src="js/ajax-mail.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script src="js/isotope.pkgd.min.js"></script>
  <script src="js/jquery.magnific-popup.js"></script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

</body>
<footer>
  @include('layouts.footer')
</footer>

</html>