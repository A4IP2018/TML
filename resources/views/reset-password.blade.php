@extends('layouts.master')

@section('content')


<div class="card card-login mx-auto mt-5">
  <div class="card-header">Resetare parol&#259;</div>
  <div class="card-body">
    <form  method="POST" action="{{ url('/reset') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_email" value="{{ $email }}">
      <div class="form-group">
        <label for="new-password">Parola nou&#259;</label>
        <input name="new-password" class="form-control" type="password" placeholder="Introduce&#539;i parola nou&#259;">
      </div>
      <div class="form-group">
        <label for="new-password-repeat">Parola din nou</label>
        <input name="new-password-repeat" class="form-control" type="password" placeholder="Introduce&#539;i parola din nou">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Schimb&#259; parola</button>
    </form>
    <div class="text-center">
      <a class="d-block small mt-3" href="{{ url('/register') }}">&#206;nregistrare</a>
      <a class="d-block small" href="{{ url('/login') }}">Logare</a>
    </div>
  </div>
</div>

@endsection
