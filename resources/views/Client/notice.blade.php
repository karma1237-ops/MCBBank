{{--
    NOTICES DE LA BANQUE  (route : /client/notice)
    Le client lit toutes les notices que le Manager lui a envoyées.
--}}
@extends('ClientLayout.master')

@section('title', 'Notice')

@section('content')
<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Notification from Bank
    </div>
    <div class="card-body">
      @forelse ($notices as $notice)
        <div class="alert alert-success">Dear {{ $client->name }},<br>{{ $notice->notice }}
          <br><small>{{ $notice->created_at }}</small>
        </div>
      @empty
        <div class="alert alert-secondary">Aucune notification</div>
      @endforelse
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
