{{--
    TRANSFERT DE FONDS - ÉTAPE 2  (route : POST /client/transferinfo, envoi vers POST /client/savetransfer)
    Affiche le compte destinataire trouvé ; le client saisit le montant.
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
      <div class="alert alert-success w-50 mx-auto">
        <form method="POST" action="{{ url('/client/savetransfer') }}">
          @csrf
          Account No.
          <input type="text" value="{{ $receiver->accountNo }}" name="otherNo" class="form-control" readonly required>
          Account Holder Name.
          <input type="text" class="form-control" value="{{ $receiver->name }}" readonly>
          Account Holder Bank Name.
          <input type="text" class="form-control" value="MCB Bank" readonly>
          Enter Amount for transfer.
          {{-- max = solde du client connecté --}}
          <input type="number" name="amount" class="form-control" min="1" max="{{ $client->balance }}" required>
          <button type="submit" name="transferSelf" class="btn btn-primary btn-sm my-1">Transfer</button>
          <a href="{{ url('/client/transfer') }}" class="btn btn-secondary btn-sm my-1">Cancel</a>
        </form>
      </div>
      <br>
      <h5>Transfer History</h5>
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
