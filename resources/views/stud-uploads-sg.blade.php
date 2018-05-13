@extends('layouts.master')

@section('content')

    <!--single HOMEWORK UPLOAD PAGE-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Teme</a>
                </li>
            </ol>


            <div class="errors card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>


            <div class="row">
                <div class="col-12">

                    <div class="card text-center">

                        <!--homework course title-->
                        @if ($homework->course)
                            <a href="{{ url('/course-sg') }}" class="card-header">{{ $homework->course->course_title }}</a>
                        @endif

                        <div class="card-body">

                            <!--homework title-->
                            <h5 class="card-title">{{ $homework->name }}</h5>

                            <!--stud homework -->
                            <p class="card-text">
                                {{ $homework->description }}
                            </p>


                            <!--homework Content-->
                            <hr>
                            <p class="card-text">Continut tema:</p>

                            <a href="{{ route('download', ['path' => $homework->file->file_name ]) }}">
                                <div class="card-columns">
                                    <div class="card" style="width: 8rem;">
                                        <div class="card-header bg-transparent border">
                                            <div class="card-body">
                                                <h6 class="card-subtitle mb-2 text-muted">{{ $homework->file->file_name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!--date/time when posted-->
                            <div class="card-footer text-muted">
                                2 days ago


                            </div>

                            @if ($grade)
                                <div class="card-footer text-muted">
                                    <h1 style="color: <?= $grade->grade < 5 ? 'red' : 'green' ?>;">
                                        Nota: {{ $grade->grade }}</h1>
                                </div>
                            @endif

                            <form style="display: flex; flex-direction: column" action="{{ URL::to('grade-action') }}"
                                  method="POST">
                                <input type="hidden" name="homework-id" value="{{ $homework->id }}">
                                <input type="hidden" name="user-id" value="{{ $user->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <input style="margin-top: 30px;margin-bottom: 30px;" type="number" name="grade"
                                       placeholder="Introducere nota">
                                <button type="submit" class="btn btn-primary">Noteaza</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            </div>
          </div>


@endsection