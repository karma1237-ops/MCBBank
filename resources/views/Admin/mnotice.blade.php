{{--
    ENVOI D'UNE NOTICE  (route : /admin/notice/{id}, envoi vers POST /admin/savenotice)
    Le Manager écrit un message qui apparaîtra chez le client concerné
    (page d'accueil et page "Notice").
--}}
@extends('AdminLayout.master')

@section('title', 'Send Notice')

@section('content')
<div class="container">
  <div class="card w-100 text-center shadowBlue">
    <div class="card-header">
      Send Notice to {{ $account->name }}
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('/admin/savenotice') }}">
        @csrf
        <div class="alert alert-success w-50 mx-auto">
          <h5>Write notice for {{ $account->name }}</h5>
          {{-- id du client destinataire --}}
          <input type="hidden" name="userId" value="{{ $account->id }}">
          <textarea class="form-control" name="notice" required placeholder="Write your message"></textarea>
          <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
        </div>
      </form>
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
