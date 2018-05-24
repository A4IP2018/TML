@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Resetare parol&#259;</div>
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
        <div class="text-center mt-4 mb-5">
          <h4>A&#539;i uitat parola?</h4>
          <p>Introduce&#539;i adresa de email pentru a primi instruc&#539;iuni de redob&#226;ndire a accesului.</p>
        </div>
        <form action="{{ url('/forgot') }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <input class="form-control" name="user-email" type="email" aria-describedby="emailHelp" placeholder="Introduce&#539;i adresa email">
          </div>
          <button type="submit" class="btn btn-primary form-control">Resetare parol&#259;</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{ url('/register') }}">&#206;nregistrare</a>
          <a class="d-block small" href="{{ url('/login') }}">Logare</a>
        </div>
      </div>
    </div>
  </div>

@endsection
