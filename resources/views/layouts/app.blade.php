<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Home</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-light container-fluid">
      <header class="row bg-info text-white">
        <div class="btn-group col-3" role="group" aria-label="Basic example">
          
        </div>
        <div class="col-1 offset-1">
          
        </div>
      </header>
      <section class="row">
      <article class="col-6 offset-3">
        @yield('content')
      </article>
      </section>
      <footer class="footer row p-3 mt-1 bg-dark text-white">
        
      </footer>
      <script src="{{ asset('js/app.js') }}"></script>
      <script type="text/javascript">
      </script>
  </body>
</html>
