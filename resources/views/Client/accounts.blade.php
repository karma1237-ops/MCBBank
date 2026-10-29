{{--
    DÉTAILS DU COMPTE BANCAIRE  (route : /client/account)
    Le client connecté consulte les informations de son propre compte.
    $client est envoyé à toutes les vues client par le middleware CheckRole.
--}}
@extends('ClientLayout.master')

@section('title', 'My Account')

@section('content')
<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Your account Information
    </div>
    <div class="card-body">
      <div class="text-center">
        <img src="{{ asset('storage/'.$client->image) }}" height="150" width="150" alt="" class="rounded-circle m-2" style="border : 5px solid #555;">
      </div>
      <table class="table table-striped table-dark w-75 mx-auto">
        <thead>
          <tr>
            <td scope="col">Account No.</td>
            <th scope="col">{{ $client->accountNo }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Holder Name</th>
            <td>{{ $client->name }}</td>
          </tr>
          <tr>
            <th scope="row">City</th>
            <td>{{ $client->city }}</td>
          </tr>
          <tr>
            <th scope="row">Account Type</th>
            <td>{{ $client->accountType }}</td>
          </tr>
          <tr>
            <th scope="row">Current Balance</th>
            <td>Rs.{{ $client->balance }}</td>
          </tr>
          <tr>
            <th scope="row">Account Created</th>
            <td>{{ $client->created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
