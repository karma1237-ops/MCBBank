{{--
    DÉTAILS D'UN CLIENT  (route : /admin/show/{id})
    Fiche complète d'un titulaire de compte (bouton View de /admin/home).
--}}
@extends('AdminLayout.master')

@section('title', 'Account profile')

@section('content')
<div class="container">
  <div class="card w-100 text-center shadowBlue">
    <div class="card-header">
      Account profile for {{ $account->name }} <kbd>#{{ $account->accountNo }}</kbd>
    </div>
    <div class="card-body bg-dark text-white">
      <div class="text-center">
        {{-- Photo enregistrée dans storage/app/public/photos --}}
        <img src="{{ asset('storage/'.$account->image) }}" height="100" width="100" alt="" class="rounded-circle m-2" style="border : 2px solid #FFF;">
      </div>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>Name</td><th>{{ $account->name }}</th>
            <td>Account No</td><th>{{ $account->accountNo }}</th>
          </tr>
          <tr>
            <td>Email</td><th>{{ $account->email }}</th>
            <td>Source of income</td><th>{{ $account->source }}</th>
          </tr>
          <tr>
            <td>Current Balance</td><th>Rs.{{ $account->balance }}</th>
            <td>Account Type</td><th>{{ $account->accountType }}</th>
          </tr>
          <tr>
            <td>Cnic</td><th>{{ $account->cnic }}</th>
            <td>City</td><th>{{ $account->city }}</th>
          </tr>
          <tr>
            <td>Contact Number</td><th>{{ $account->number }}</th>
            <td>Address</td><th>{{ $account->address }}</th>
          </tr>
        </tbody>
      </table>
      <a href="{{ url('/admin/home') }}" class="btn btn-outline-light btn-sm">Back</a>
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
