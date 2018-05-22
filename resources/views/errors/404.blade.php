@extends('layouts.master')

@section('content')

    <!--BLANK PAGE EXAMPLE-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    You just got bamboozled.
                </li>
            </ol>

            <div class="row">
                <div class="col-md-12">
                    <div style="margin-top:1%;margin-left: 20%;margin-bottom: 40%">
                        <div class="col-md-10 col-md-offset-1 pull-right">
                            <img class="img-error" src="{{ asset('images/not-found.png') }}">
                            <h1>404 Not Found</h1>
                            <p>Ne cerem scuze, pagina cautata nu a fost gasita!</p>
                            <div class="error-actions" style="margin-left: 20%">
                                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                    Acasa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->



@endsection