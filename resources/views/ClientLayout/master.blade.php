{{--
    =====================================================================
    LAYOUT PRINCIPAL DE L'ESPACE CLIENT
    ---------------------------------------------------------------------
    Structure HTML commune à toutes les pages du client.
    Les pages enfants font @extends('ClientLayout.master')
    et remplissent la section "content".
    =====================================================================
--}}
<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Banking') - MCB Bank</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
    <script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
      // Active les info-bulles Bootstrap
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });
    </script>
  </head>

  <body style="background:#96D678;background-size: 100%">

    {{-- Barre de navigation du client --}}
    @include('ClientLayout.header')

    {{-- Messages de succès / d'erreur --}}
    @include('messages')

    {{-- Contenu propre à chaque page --}}
    @yield('content')

  </body>
</html>
