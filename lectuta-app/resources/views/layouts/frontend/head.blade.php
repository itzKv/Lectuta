<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('../template/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('../template/assets/img/favicon.png')}}">
  <title>
    Lectuta
  </title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  

  <!-- Nucleo Icons -->
  <link href="{{asset('../template/assets/css/nucleo-icons.css" rel="stylesheet')}}" />
  <link href="{{asset('../template/assets/css/nucleo-svg.css" rel="stylesheet')}}" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('../template/assets/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />

  <!--   Core JS Files   -->
  <script src="{{asset('../template/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('../template/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('../template/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('../template/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('../template/assets/js/jquery.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('../template/assets/js/material-dashboard.min.js?v=3.1.0')}}"></script>

  <style>
    body {
        font-family: 'Roboto', sans-serif;
        color: black;
    }
    </style>
</head>