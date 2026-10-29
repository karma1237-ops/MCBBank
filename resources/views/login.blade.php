{{--
    PAGE DE CONNEXION  (route : /login)
    Page commune aux 3 profils : Client (User), Manager et Caissier.
    Elle n'utilise pas de layout car elle n'a pas de barre de navigation.
    Les 3 formulaires envoient en POST vers /login ; le nom du bouton
    (userLogin, managerLogin, cashierLogin) indique quel profil se connecte.
--}}
<!DOCTYPE html>
<html>
  <head>
    <title>Login - MCB Bank</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}"> // sans asset() ça ne fonctionne pas sur le serveur distant, il permet de ne pas casser les liens si l'application est dans un sous-dossier.(chemin absolu)
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/font-awesome/css/font-awesome.min.css') }}">
    <script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  </head>

  <body style="background: url({{ asset('frontend/images/bg-login2.jpg') }});background-size: 100%">
    <h1 class="alert alert-success rounded-0">MCB Bank</h1>
    <br>
    <br>
    <div id="accordion" role="tablist" class="w-25 float-right shadowBlack" style="margin-right: 222px">
      <br><h4 class="text-center text-white">Select Your Session</h4>

      {{-- 1) Connexion Client --}}
      <div class="card rounded-0">
        <div class="card-header" role="tab" id="headingOne">
          <h5 class="mb-0">
            <a class="btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">User Login</a>
          </h5>
        </div>
        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            <form method="POST" action="{{ url('/login') }}">
              @csrf
              <input type="email" name="email" class="form-control" required placeholder="Enter Email">
              <input type="password" name="password" class="form-control" required placeholder="Enter Password">
              <button type="submit" class="btn btn-primary btn-block btn-sm my-1">Enter</button>
            </form>
          </div>
        </div>
      </div>

      {{-- 2) Connexion Manager --}}
      <div class="card rounded-0">
        <div class="card-header" role="tab" id="headingTwo">
          <h5 class="mb-0">
            <a class="collapsed btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Manager Login</a>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            <form method="POST" action="{{ url('/login') }}">
              @csrf
              <input type="email" name="email" class="form-control" required placeholder="Enter Email">
              <input type="password" name="password" class="form-control" required placeholder="Enter Password">
              <button type="submit" class="btn btn-primary btn-block btn-sm my-1">Enter</button>
            </form>
          </div>
        </div>
      </div>

      {{-- 3) Connexion Caissier --}}
      <div class="card rounded-0">
        <div class="card-header" role="tab" id="headingThree">
          <h5 class="mb-0">
            <a class="collapsed btn btn-outline-success btn-block" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Cashier Login</a>
          </h5>
        </div>
        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
            <form method="POST" action="{{ url('/login') }}">
              @csrf
              <input type="email" name="email" class="form-control" required placeholder="Enter Email">
              <input type="password" name="password" class="form-control" required placeholder="Enter Password">
              <button type="submit" class="btn btn-primary btn-block btn-sm my-1">Enter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
