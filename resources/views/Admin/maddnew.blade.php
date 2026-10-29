{{--
    CRÉATION D'UN COMPTE BANCAIRE  (route : /admin/addnew, envoi vers POST /admin/saveaccount)
    Formulaire rempli par le Manager pour ouvrir un compte client.
    old('champ') garde la saisie si la validation échoue.
--}}
@extends('AdminLayout.master')

@section('title', 'New Account')

@section('content')
<div class="container">
  <div class="card w-100 text-center shadowBlue">
    <div class="card-header">
      New Account Form
    </div>
    <div class="card-body bg-dark text-white">
      {{-- enctype obligatoire pour envoyer la photo --}}
      <form method="POST" action="{{ url('/admin/saveaccount') }}" enctype="multipart/form-data">
        @csrf
        <table class="table">
          <tbody>
            <tr>
              <th>Name</th>
              <td><input type="text" name="name" value="{{ old('name') }}" class="form-control input-sm" required></td>
              <th>CNIC</th>
              <td><input type="number" name="cnic" value="{{ old('cnic') }}" class="form-control input-sm" required></td>
            </tr>
            <tr>
              <th>Account Number</th>
              {{-- Numéro généré automatiquement par AdminController@addnew --}}
              <td><input type="text" name="accountNo" readonly value="{{ $accountNo }}" class="form-control input-sm" required></td>
              <th>Account Type</th>
              <td>
                <select class="form-control input-sm" name="accountType" required>
                  <option value="current">Current</option>
                  <option value="saving" selected>Saving</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>City</th>
              <td><input type="text" name="city" value="{{ old('city') }}" class="form-control input-sm" required></td>
              <th>Address</th>
              <td><input type="text" name="address" value="{{ old('address') }}" class="form-control input-sm" required></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><input type="email" name="email" value="{{ old('email') }}" class="form-control input-sm" required></td>
              <th>Password</th>
              <td><input type="password" name="password" class="form-control input-sm" required></td>
            </tr>
            <tr>
              <th>Deposit</th>
              <td><input type="number" name="balance" min="500" value="{{ old('balance') }}" class="form-control input-sm" required></td>
              <th>Source of income</th>
              <td><input type="text" name="source" value="{{ old('source') }}" class="form-control input-sm" required></td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td><input type="number" name="number" value="{{ old('number') }}" class="form-control input-sm" required></td>
              <th>Photo</th>
              <td><input type="file" name="image" class="form-control input-sm" required></td>
            </tr>
            <tr>
              <td colspan="4">
                <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Save Account</button>
                <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
