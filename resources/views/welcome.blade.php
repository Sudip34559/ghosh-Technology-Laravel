<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Ghosh Technology</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('Admin/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('Admin/assets/img/download.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('Admin/assets/img/download.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('Admin/assets/img/download.png')}}">
    <link rel="manifest" href="{{asset('Admin/assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('Admin/assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset('Admin/vendors/overlayscrollbars/OverlayScrollbars.min.js')}}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{asset('Admin/vendors/hamburgers/hamburgers.min.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendors/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/vendors/loaders.css/loaders.min.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/assets/css/theme.min.css')}}" rel="stylesheet" />
    <link href="{{asset('Admin/assets/css/user.min.css')}}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&amp;family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
  </head>

  <body>
    @yield('display')
    <script src="{{asset('Admin/vendors/popper/popper.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/is/is.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/bigpicture/BigPicture.js')}}"> </script>
    <script src="{{asset('Admin/vendors/countup/countUp.umd.js')}}"> </script>
    <script src="{{asset('Admin/vendors/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/lodash/lodash.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('Admin/vendors/gsap/gsap.js')}}"></script>
    <script src="{{asset('Admin/vendors/gsap/customEase.js')}}"></script>
    <script src="{{asset('Admin/assets/js/theme.js')}}"></script>
  </body>
</html>