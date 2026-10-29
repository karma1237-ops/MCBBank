{{--
    =====================================================================
    LAYOUT PRINCIPAL DE L'ESPACE ADMIN (Manager + Caissier)
    ---------------------------------------------------------------------
    Ce fichier contient la structure HTML commune à toutes les pages admin :
    <head> (CSS/JS), barre de navigation, puis la zone de contenu.
    Les pages enfants l'utilisent avec @extends('AdminLayout.master')
    et remplissent la section "content".
    La barre de navigation dépend du rôle en session :
    Manager = AdminLayout.header, Caissier = AdminLayout.sidebar.
    =====================================================================
--}}
<!DOCTYPE html>
<html>
  <head>
    {{-- Titre de l'onglet : chaque page peut le personnaliser avec @section('title') --}}
    <title>@yield('title', 'Banking') - MCB Bank</title>

    {{-- asset() génère l'URL vers le dossier public/ --}}
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
    {{-- Barre de navigation selon le rôle connecté : Caissier (sidebar) ou Manager (header) --}}
    @if (session('role') == 'cashier')
      @include('AdminLayout.sidebar')
    @else
      @include('AdminLayout.header')
    @endif

    {{-- Messages de succès / d'erreur --}}
    @include('messages')

    {{-- Contenu propre à chaque page --}}
    @yield('content')

    {{-- Fenêtres modales éventuelles (ex : ajout / modification caissier) --}}
    @yield('modals')
  </body>
</html>
