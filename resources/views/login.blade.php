@extends('layouts.master')

@section('content')

<div class="container">
  <div class="card card-login mx-auto mt-5">
    <div class="card-header">Logare</div>
    <div class="card-body">
      <form  method="POST" action="{{ route('login-action') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="login-email">Email</label>
          <input name="email" class="form-control" id="login-email" type="text" aria-describedby="emailHelp" placeholder="Introduce&#539;i adresa email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Parola</label>
          <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Introduce&#539;i parola">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Logare</button>
      </form>
      <div class="text-center">
        <a class="d-block small mt-3" href="{{ url('/register') }}">&#206;nregistrare</a>
        <a class="d-block small" href="{{ url('/forgot') }}">A&#539;i uitat parola?</a>
      </div>
    </div>
  </div>
</div>

@endsection
