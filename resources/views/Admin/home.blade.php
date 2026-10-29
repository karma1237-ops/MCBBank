{{--
    PAGE D'ACCUEIL DU MANAGER  (route : /admin/home)
    Affiche la liste de tous les comptes bancaires des clients,
    avec les actions : voir le détail, envoyer une notice, supprimer.
--}}
@extends('AdminLayout.master')

@section('title', 'Home')

@section('content')
<div class="container">
  <div class="card w-100 text-center shadowBlue">
    <div class="card-header">
      All accounts
    </div>
    <div class="card-body">
      <table class="table table-bordered table-sm bg-dark text-white">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Holder Name</th>
            <th scope="col">Account No.</th>
            <th scope="col">City</th>
            <th scope="col">Current Balance</th>
            <th scope="col">Account type</th>
            <th scope="col">Contact</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          {{-- Une ligne par compte (variable $accounts envoyée par AdminController@home) --}}
          @forelse ($accounts as $account)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $account->name }}</td>
              <td>{{ $account->accountNo }}</td>
              <td>{{ $account->city }}</td>
              <td>Rs.{{ $account->balance }}</td>
              <td>{{ $account->accountType }}</td>
              <td>{{ $account->number }}</td>
              <td>
                <a href="{{ url('/admin/show/'.$account->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="View More info">View</a>
                <a href="{{ url('/admin/notice/'.$account->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Send notice to this">Send Notice</a>
                {{-- Suppression : formulaire avec la méthode DELETE --}}
                <form action="{{ url('/admin/deleteaccount/'.$account->id) }}" method="POST" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce compte ?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="8">Aucun compte pour le moment</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
