@extends('layouts.master')


@section('content')

    <!--MULTIPLE HOMEWORK PAGE-->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Bord</a>
                </li>
                <li class="breadcrumb-item active">Teme</li>
            </ol>

            <div class="row">
                <div class="col-12">

                    <div class="input-group">
                        <!--search for homework-->
                        <input name="homework-search" class="form-control" type="text" placeholder="Cauta tema...">
                        <span class="input-group-append">
            <button class="btn btn-primary" type="button">
            <i class="fa fa-search"></i>
            </button>
          </span>
                    </div>

                    <!--press to create new homework <TEACHER>-->
                    <br><a href="{{ url('/homework/create') }}" class="btn btn-primary btn-lg btn-block">Tema noua</a>

                    <!--press to compare homework <TEACHER>-->
                    <a href="{{ url('/compare') }}" class="btn btn-secondary btn-lg btn-block">Compara</a>

                    <div class="mb-0 mt-4">
                        <i class="fa fa-newspaper-o"></i> ...
                    </div>
                    <hr class="mt-2">

                    <div class="card-columns">
                    @if ($homeworks)
                        @foreach ($homeworks as $homework)
                            <!-- Example Homework Card-->
                                <div class="card mb-3">
                                    <div class="card-header bg-transparent border">
                                        @if ($homework->course)
                                        <a href="{{ url('/course-sg') }}">{{ $homework->course->course_title }}</a>
                                        @endif
                                    </div>
                                    <div class="card-body text">
                                        <!--Homework title-->
                                        <h5 class="card-title">{{ $homework->name }}</h5>
                                        <!--Homework description-->
                                        <p class="card-text">{{ $homework->description }}</p>
                                    </div>

                                    <!--Homework format-->
                                    <div class="card-footer bg-transparent border">
                                        @if ($homework->course)
                                            Curs: {{ $homework->course->course_title  }}
                                        @endif
                                    </div>
                                    <!--Homework deadline-->
                                    <div class="card-footer bg-transparent border">Termen
                                        limita: {{ $homework->deadline }}</div>
                                    <div class="card-footer bg-transparent border">
                                        <!--go to homework upload-->
                                        <a href="{{ url('/upload/' . $homework->slug) }}"
                                           class="btn btn-primary">Upload</a>
                                        <!--go to homework page-->
                                        <a href="{{ url('/homework/' . $homework->slug) }}"
                                           class="btn btn-info">Detalii</a>
                                        <!--go to request page-->
                                        <a href="{{ url('/request') }}" class="btn btn-info">Cerere</a>
                                        <!--Add member to homework <TEACHER>-->
                                        <a href="#" class="btn btn-primary">Adauga membri</a>
                                        <!--Homework edit <TEACHER>-->
                                        <a href="{{ url('/homework/' . $homework->slug . '/edit') }}"
                                           class="btn btn-secondary">Editeaza</a>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                    </div>


                    <!--pagination-->
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Inapoi</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">Inainte</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@endsection