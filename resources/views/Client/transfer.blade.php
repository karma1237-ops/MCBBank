{{--
    TRANSFERT DE FONDS - ÉTAPE 1  (route : /client/transfer, envoi vers POST /client/transferinfo)
    Le client saisit le numéro de compte du destinataire.
    L'historique de ses transferts envoyés est affiché en dessous.
--}}
@extends('ClientLayout.master')

@section('title', 'Funds Transfer')

@section('content')
<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Funds Transfer
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('/client/transferinfo') }}">
        @csrf
        <div class="alert alert-success w-50 mx-auto">
          <h5>New Transfer</h5>
          <input type="text" name="otherNo" class="form-control" placeholder="Enter Receiver Account number" required>
          <button type="submit" name="get" class="btn btn-primary btn-sm my-1">Get Account Info</button>
        </div>
      </form>
      <br>
      <h5>Transfer History</h5>
      {{-- Historique des transferts envoyés --}}
      @forelse ($history as $item)
        <div class="alert alert-warning">Transfer have been made for Rs.{{ $item->debit }} from your account at {{ $item->created_at }} in account no.{{ $item->other }}</div>
      @empty
        <div class="alert alert-secondary">Aucun transfert pour le moment</div>
      @endforelse
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
