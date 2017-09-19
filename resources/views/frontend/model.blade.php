<!DOCTYPE html>
<html>
    <head>

        <!-- /.website title -->
        <title>{{ config('app.name', 'Laravel Admin LTE') }} {{ (isset($pageTitle)?$pageTitle:'') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta charset="utf-8">

        <!-- CSS Files -->
        <link href="{{ asset('backyard/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
        <link href="{{ asset('backyard/css/font-awesome.min.css') }}" rel="stylesheet" media="screen">
        <link href="{{ asset('backyard/fonts/icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" media="screen">
        <link href="{{ asset('backyard/css/animate.css') }}" rel="stylesheet" media="screen">
        <link href="{{ asset('backyard/css/owl.theme.css') }}" rel="stylesheet" media="screen">
        <link href="{{ asset('backyard/css/owl.carousel.css') }}" rel="stylesheet" media="screen">

        <!-- Colors -->
        <!-- <link href="css/css-index.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-green.css" rel="stylesheet" media="screen"> -->
        <link href="{{ asset('backyard/css/css-index-green.css') }}" rel="stylesheet" media="screen">
        <!-- <link href="css/css-index-purple.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-red.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-orange.css" rel="stylesheet" media="screen"> -->
        <!-- <link href="css/css-index-yellow.css" rel="stylesheet" media="screen"> -->

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

        @stack('css')

    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

      @yield('content')

      @include('frontend.footer')

      <!-- /.javascript files -->
      <script src="{{ asset('backyard/js/jquery.js') }}"></script>
      <script src="{{ asset('backyard/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('backyard/js/custom.js') }}"></script>
      <script src="{{ asset('backyard/js/jquery.sticky.js') }}"></script>
      <script src="{{ asset('backyard/js/wow.min.js') }}"></script>
      <script src="{{ asset('backyard/js/owl.carousel.min.js') }}"></script>
      <script>
        new WOW().init();
      </script>
      @stack('scripts')
    </body>
</html>
