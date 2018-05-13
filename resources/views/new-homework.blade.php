@extends('layouts.master')


@section('content')

    <!--NEW HOMEWORK page-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Bord</a>
                </li>
                <li class="breadcrumb-item active">Teme</li>
                <li class="breadcrumb-item active">Tema Noua</li>
            </ol>

            <div class="errors">
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

            <form action="{{ \Illuminate\Support\Facades\URL::to('homework') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="hw-title">Titlu:</label>
                            <input type="text" name="name" class="form-control" id="hw-title"
                                   placeholder="Alege un titlu">
                        </div>
                        <div class="form-group">

                            <label for="sel1">Curs:</label>
                            <select class="form-control" name="course" id="hw-curssel">
                                @if ($teacherCourses)
                                   @foreach($teacherCourses as $teacherCours)
                                        <option value="{{ $teacherCours->id }}">{{ $teacherCours->course_title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hw-descr">Descriere:</label>
                            <textarea class="form-control" name="description" rows="5" id="hw-descr"
                                      placeholder="Alege o descriere"></textarea>
                        </div>

                        <div class="form-group row">

                            <label for="example-date-input" class="col-1 col-form-label">Termen limita:</label>

                            <!--Homework deadline-->
                            <div class="col-10">
                                <input class="form-control" name="deadline" type="date" value="2018-08-19"
                                       id="example-date-input">
                            </div>
                        </div>

                        <!--Homework format-->
                        <div class="format" style="text-align: center;">
                            <h2>Format:</h2>

                            @if ($formats)
                                @foreach ($formats as $format)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input name="format[]" type="checkbox" class="form-check-input"
                                                   value="{{ $format->id }}">
                                            {{ $format->extension_name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <button style="display: flex; margin: auto; margin-top: 30px;" type="submit"
                                class="btn btn-primary">Salveaza
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

@endsection
