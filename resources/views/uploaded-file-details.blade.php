@extends('layouts.master')

@section('content')

    <!--single HOMEWORK UPLOAD PAGE-->

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                Vizualizare tema
            </li>
        </ol>

        @if ($errors->any())
        <div class="errors card">

                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

        </div>
        @endif

        <div class="card-group">
            <div class="card mb-3 text-center">
                <div class="card-header">Curs</div>
                <div class="card-body">
                    <a href="{{ url('/course/' . $file->homework->course->slug ) }}">{{ $file->homework->course->course_title }}</a>
                </div>
            </div>
            <div class="card mb-3 text-center">
                <div class="card-header">Uploadat</div>
                <div class="card-body">
                    <?php
                        $diff = \Carbon\Carbon::now()->diffInDays($file->created_at);
                        echo ($diff == 0) ? 'Azi' : $diff . ' zile in urma';
                    ?>
                </div>
            </div>
            <div class="card mb-3 text-center">
                <div class="card-header">Fisier</div>
                <div class="card-body">
                    <a href="{{ url('/download/' . $file->file_name) }}">Descarca</a>
                </div>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header text-center">{{ $file->file_name }}</div>
            <div class="card-body">
                <pre><code>{{ $content }}</code></pre>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header">Nota</div>
            <div class="card-body">
                <form class="form-group" action="{{ URL::to('grade-action') }}" method="POST">
                    <div class="row">
                        <input type="hidden" name="homework-id" value="{{ $file->homework->id }}">
                        <input type="hidden" name="user-id" value="{{ $file->user->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col col-6 form-group">
                            <input class="form-control" type="number" name="grade"
                                   placeholder="Introducere nota">
                        </div>
                        <div class="col col-6 form-group">
                            <button type="submit" class="btn btn-primary form-control">Noteaza</button>
                        </div>
                    </div>
                </form>
            </div>








        </div>
    </div>
</div>


@endsection