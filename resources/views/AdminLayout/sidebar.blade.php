{{--
    BARRE DE NAVIGATION DU CAISSIER
    Incluse par AdminLayout.master quand session('role') == 'cashier'.
--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="{{ url('/cashier/home') }}">
    <img src="{{ asset('frontend/images/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
    MCB Bank
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active" href="{{ url('/cashier/home') }}">Home</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button type="button" class="btn btn-outline-success">Welcome Cashier</button>
      <a href="{{ url('/logout') }}" data-toggle="tooltip" title="Logout" class="btn btn-outline-danger mx-1"><i class="fa fa-sign-out fa-fw"></i></a>
    </form>
  </div>
</nav><br><br><br>
