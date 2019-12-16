<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Styles -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    />
    <!-- Bootstrap core CSS -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" />
  <link href="{{asset('css/notifIt.css')}}" rel="stylesheet"/>

    <!-- Scripts -->
    <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
    </script>
    <style>
    
    .modal-notify .modal-header {
    border-radius: 3px 3px 0 0;
      }
    .modal-notify .modal-content {
    border-radius: 3px;
}
    </style>
  </head>
  <body class="fixed-sn white-skin">
    <div id="app">
      @include('inc.userNav') 
      <main>
          @yield('content')
      </main>
    </div>

    <!-- Scripts -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    ></script>
    <!-- Bootstrap tooltips -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"
    ></script>
    <!-- Bootstrap core JavaScript -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"
    ></script>
    <!-- MDB core JavaScript -->
    <script src="{{asset('js/notifIt.js')}}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    <script>
      $(document).ready(() => {
        // SideNav Initialization
        $(".button-collapse").sideNav();

        new WOW().init();
      });
      $(document).ready(function() {
        $('.mdb-select').materialSelect();
      })
      
    </script>
  </body>
</html>
