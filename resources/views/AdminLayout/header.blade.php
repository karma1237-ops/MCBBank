{{--
    BARRE DE NAVIGATION DU MANAGER
    Incluse automatiquement par AdminLayout.master.
    url('/chemin') génère l'URL complète d'une route définie dans routes/web.php.
--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="{{ url('/admin/home') }}">
    <img src="{{ asset('frontend/images/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
    MCB Bank
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      {{-- request()->is() permet de surligner le lien de la page courante --}}
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}" href="{{ url('/admin/home') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/cashiers') ? 'active' : '' }}" href="{{ url('/admin/cashiers') }}">Accounts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/addnew') ? 'active' : '' }}" href="{{ url('/admin/addnew') }}">Add New Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/feedbacks') ? 'active' : '' }}" href="{{ url('/admin/feedbacks') }}">Feedback</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button type="button" class="btn btn-outline-success">Welcome Manager</button>
      <a href="{{ url('/logout') }}" data-toggle="tooltip" title="Logout" class="btn btn-outline-danger mx-1"><i class="fa fa-sign-out fa-fw"></i></a>
    </form>
  </div>
</nav><br><br><br>
