<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">

    <title>@yield('title')</title>
  </head>
  <body>
    <div class="container">
      <div class="mt-5">
        @yield('content')
      </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/toast.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    @yield("scripts")
  </body>
</html>