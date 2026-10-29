{{--
    FEEDBACKS REÇUS  (route : /admin/feedbacks)
    Le Manager consulte les messages envoyés par les clients
    (jointure feedbacks + accounts) et peut les supprimer.
--}}
@extends('AdminLayout.master')

@section('title', 'Feedback')

@section('content')
<div class="container">
  <div class="card w-100 text-center shadowBlue">
    <div class="card-header">
      Feedback from Account Holder
    </div>
    <div class="card-body">
      <table class="table table-bordered table-sm bg-dark text-white">
        <thead>
          <tr>
            <th scope="col">From</th>
            <th scope="col">Account No.</th>
            <th scope="col">Contact</th>
            <th scope="col">Message</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($feedbacks as $feedback)
            <tr>
              <td>{{ $feedback->name }}</td>
              <td>{{ $feedback->accountNo }}</td>
              <td>{{ $feedback->number }}</td>
              <td>{{ $feedback->message }}</td>
              <td>{{ $feedback->created_at }}</td>
              <td>
                <form action="{{ url('/admin/deletefeedback/'.$feedback->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce message ?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6">Aucun feedback pour le moment</td></tr>
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
