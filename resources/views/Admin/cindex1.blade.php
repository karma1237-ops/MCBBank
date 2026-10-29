{{--
    OPÉRATIONS DU CAISSIER  (route : POST /cashier/search, envoi vers POST /cashier/operation)
    Affiche le compte trouvé et permet un retrait ou un dépôt.
    Chaque formulaire envoie le numéro de compte dans un champ caché.
--}}
@extends('AdminLayout.master')

@section('title', 'Cashier - Account')

@section('content')
<div class="row w-100" style="padding: 11px">
  <div class="col">
    <div class="card text-center w-75 mx-auto">
      <div class="card-header">
        Account Information
      </div>
      <div class="card-body">
        <div class="row">
          {{-- Colonne gauche : informations du compte --}}
          <div class="col">
            Account No.
            <input type="text" value="{{ $account->accountNo }}" class="form-control" readonly>
            Account Holder Name.
            <input type="text" class="form-control" value="{{ $account->name }}" readonly>
            Account Holder Bank Name.
            <input type="text" class="form-control" value="MCB Bank" readonly>
            Bank Balance
            <input type="text" class="form-control my-1" value="Rs.{{ $account->balance }}" readonly>
          </div>
          {{-- Colonne droite : retrait et dépôt --}}
          <div class="col">
            Transaction Process.
            <form method="POST" action="{{ url('/cashier/operation') }}">
              @csrf
              <input type="hidden" name="otherNo" value="{{ $account->accountNo }}">
              <div class="form-group">
                <input type="number" class="form-control my-1" name="amount" placeholder="Write Amount for withdraw" min="1" max="{{ $account->balance }}" required>
              </div>
              <button type="submit" name="withdraw" class="btn btn-primary btn-sm my-1">Withdraw</button>
            </form>
            <form method="POST" action="{{ url('/cashier/operation') }}">
              @csrf
              <input type="hidden" name="otherNo" value="{{ $account->accountNo }}">
              <div class="form-group">
                <input type="number" class="form-control my-1" name="amount" placeholder="Write Amount for deposit" min="1" required>
              </div>
              <button type="submit" name="deposit" class="btn btn-success btn-sm my-1">Deposit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
        MCB Bank
      </div>
    </div>
  </div>
</div>
@endsection
