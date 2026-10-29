{{--
    NOTE DE FEEDBACK  (route : /client/feedback, envoi vers POST /client/savefeedback)
    Le client envoie un message (feedback) à la banque.
--}}
@extends('ClientLayout.master')

@section('title', 'Feedback')

@section('content')
<div class="container">
  <div class="card w-75 mx-auto">
    <div class="card-header text-center">
      Help Card
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('/client/savefeedback') }}">
        @csrf
        <div class="alert alert-success w-50 mx-auto">
          <h5>Enter your message</h5>
          <textarea class="form-control" name="msg" required placeholder="Write your message"></textarea>
          <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
        </div>
      </form>
      <br>
    </div>
    <div class="card-footer text-muted">
      MCB Bank
    </div>
  </div>
</div>
@endsection
