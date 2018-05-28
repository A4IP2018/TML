@extends('layouts.master')

@section('content')

<div class="card-group text-center">
    <div class="card">
        <div class="card-header">Curs</div>
        <div class="card-body">
            <a href="{{ url('/course/' . $batch_info['homework']->course->slug ) }}">{{ $batch_info['homework']->course->course_title }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">&#206;nc&#259;rcat&#259;</div>
        <div class="card-body">
            <?php
            $diff = $batch_info['created_at']->diffForHumans(\Carbon\Carbon::now());
            echo $diff
            ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Autor</div>
        <div class="card-body">
            <a href="{{ url('/user/' . $batch_info['user']->id) }}">{{ get_name_by_id($batch_info['user']->id) }}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Fisiere</div>
        <div class="card-body">
            <a href="{{ url('/upload/' . $batch_info['batch_id'] . '/download') }}">Descarc&#259;</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Nota</div>
        <div class="card-body">
            <div class="grade">

            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Nota</div>
    <div class="card-body">
        <form class="form-group" action="{{ URL::to('grade-action') }}" method="POST">
            <div class="row">
                <input type="hidden" name="homework-id" value="">
                <input type="hidden" name="user-id" value="">
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

<div class="card text-center">
    <div class="card-header">Adauga un comentariu</div>
    <div class="card-body">
        <div class="form-group">
            <form action="{{ \Illuminate\Support\Facades\URL::to('/file-comments-action') }}"
                  method="POST">
                {{ csrf_field() }}
                <input name="file-id" type="hidden" value="">
                <textarea class="form-control" name="comments" id="" rows="2" style="width:100%"></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Posteaza</button>
            </form>
        </div>

    </div>
</div>
<br>


<!--COMMENTS TEST-->
{{--
@if ($file->comments && (is_file_author($file) || is_homework_author($file->homework)))
    @foreach($file->comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title mb-1"><a href="#">{{ $comment->user->student_information->last_name }} {{ $comment->user->student_information->first_name }}</a> <small> 13:50 </small>
                </h6>
                <p class="card-text small">
                    {{ $comment->comment }}
                </p>
            </div>
            <hr class="my-0">
        </div>
    @endforeach
@endif
--}}
@endsection