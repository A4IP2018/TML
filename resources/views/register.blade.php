@extends('layouts.master')

@section('content')
<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Register an Account</div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card-body">
      <form method="POST" action="{{ route('register-action') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleInputName">Prenume</label>
              <input name="first-name" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
            </div>
            <div class="col-md-6">
              <label for="exampleInputLastName">Nume</label>
              <input name="last-name" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Adresa Email</label>
          <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Introducere email">
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleInputPassword1">Parola</label>
              <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Introducere parola">
            </div>
            <div class="col-md-6">
              <label for="exampleConfirmPassword">Confirma parola</label>
              <input name="confirm-password" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Introducere parola">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
      </form>
      <div class="text-center">
        <a class="d-block small mt-3" href="login.html">Login Page</a>
        <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
      </div>
    </div>
  </div>
</div>

@endsection
