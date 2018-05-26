@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="error text-center">
            <img class="img-error" src="{{ asset('images/not-found.png') }}">
            <h1 class="text-center">404</h1>
            <p>Ne cerem scuze, pagina cautat&#259; nu a fost g&#259;sit&#259;!</p>
            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    Acas&#259;
                </a>
            </div>
        </div>
    </div>
</div>




@endsection