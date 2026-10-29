{{--
    RELEVÉ BANCAIRE  (route : /client/statements)
    Toutes les opérations du client (dépôts, retraits, transferts), 10 par page.
    Un message différent est affiché selon le type d'opération.
--}}
@extends('ClientLayout.master')

@section('title', 'Statements')

@section('content')
<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Transaction made against your account
    </div>
    <div class="card-body">
      @forelse ($transactions as $t)
        @if ($t->action == 'withdraw')
          <div class="alert alert-secondary">You withdraw Rs.{{ $t->debit }} from your account at {{ $t->created_at }}</div>
        @elseif ($t->action == 'deposit')
          <div class="alert alert-success">You deposit Rs.{{ $t->credit }} in your account at {{ $t->created_at }}</div>
        @elseif ($t->debit)
          <div class="alert alert-warning">You transfer Rs.{{ $t->debit }} to account no.{{ $t->other }} at {{ $t->created_at }}</div>
        @else
          <div class="alert alert-info">You received Rs.{{ $t->credit }} from account no.{{ $t->other }} at {{ $t->created_at }}</div>
        @endif
      @empty
        <div class="alert alert-secondary">Aucune opération pour le moment</div>
      @endforelse

      {{-- Liens de pagination --}}
      {{ $transactions->links() }}
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
