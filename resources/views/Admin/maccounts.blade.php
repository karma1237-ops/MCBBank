{{--
    GESTION DES CAISSIERS - CRUD  (route : /admin/cashiers)
    Read : liste des caissiers
    Create : modale "New Cashier Account"  -> POST /admin/savecashier
    Update : une modale "Edit" par caissier -> PUT /admin/updatecashier/{id}
    Delete : bouton Delete                  -> DELETE /admin/deletecashier/{id}
--}}
@extends('AdminLayout.master')

@section('title', 'Staff Accounts')

@section('content')
<div class="container">
  <div class="card w-100 text-center shadowBlue">
    <div class="card-header">
      All Staff Accounts
      <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Add New Account</button>
    </div>
    <div class="card-body bg-dark text-white">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Email</th>
            <th>Account Type</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($cashiers as $cashier)
            <tr>
              <td>{{ $cashier->email }}</td>
              <td>{{ $cashier->type }}</td>
              <td>{{ $cashier->created_at }}</td>
              <td>
                {{-- Chaque caissier a son propre modal de modification --}}
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $cashier->id }}">Edit</a>
                <form action="{{ url('/admin/deletecashier/'.$cashier->id) }}" method="POST" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce caissier ?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4">Aucun caissier pour le moment</td></tr>
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

@section('modals')
{{-- Modale : ajout d'un caissier (Create) --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('/admin/savecashier') }}">
          @csrf
          <div class="form-group">
            <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
          </div>
          <div class="form-group">
            <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="Password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modales : modification d'un caissier (Update), une par caissier pour pré-remplir son email --}}
@foreach ($cashiers as $cashier)
<div class="modal fade" id="editModal{{ $cashier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title">Edit Cashier Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('/admin/updatecashier/'.$cashier->id) }}">
          @csrf
          @method('PUT')
          <div class="form-group">
            <input class="form-control w-75 mx-auto" type="email" name="email" value="{{ $cashier->email }}" required placeholder="Email">
          </div>
          <div class="form-group">
            <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="New Password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
