@extends('layouts.master')

@section('content')

<div class="card card-register mx-auto mt-5">
  <div class="card-header">&#206;nregistrare</div>
  <div class="card-body">
    <form method="POST" action="{{ url('/register') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <label for="exampleInputName">Prenume</label>
            <input name="first-name" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Introduce&#539;i prenumele">
          </div>
          <div class="col-md-6">
            <label for="exampleInputLastName">Nume</label>
            <input name="last-name" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Introduce&#539;i numele">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Adres&#259; Email</label>
        <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Introduce&#539;i email">
      </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <label for="password">Parola</label>
            <input name="password" class="form-control" type="password" placeholder="Introduce&#539;i parola">
          </div>
          <div class="col-md-6">
            <label for="confirm-password">Confirm&#259; parola</label>
            <input name="confirm-password" class="form-control" type="password" placeholder="Repeta&#539;i parola">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-12">
            <label for="code">Cod secret</label>
            <input name="code" class="form-control" type="text" placeholder="Cod secret pentru &#238;nregistrare privilegiat&#259; (optional)">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Continu&#259;</button>
    </form>
    <div class="text-center">
      <a class="d-block small mt-3" href="{{ url('/login') }}">Deja sunteti &#238;nregistrat?</a>
      <a class="d-block small" href="{{ url('/forgot') }}">A&#539;i uitat parola?</a>
    </div>
  </div>
</div>

@endsection
