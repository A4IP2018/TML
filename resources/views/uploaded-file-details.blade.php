@extends('layouts.master')

@section('content')

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
            <a href="{{ url('/download/' . basename($file->storage_path)) }}">Descarca</a>
        </div>
    </div>
    @if($file->grade && $file->grade->grade)
        <div class="card mb-3 text-center">
            <div class="card-header">Nota</div>
            <div class="card-body">
                <div class="grade">
                    <span style="color: <?= $file->grade->grade >= 5 ? 'green' : 'red' ?>">{{ $file->grade->grade }}</span>
                </div>
            </div>
        </div>
    @endif
</div>

<br>

<div class="card">
    <div class="card-header text-center">{{ $file->file_name }}</div>
    <div class="card-body">
        <pre><code>{{ $content }}</code></pre>
    </div>
</div>

<br>

@if (is_course_teacher($file->homework->course->id))
<div class="card">
    <div class="card-header">Nota</div>
    <div class="card-body">
        <form class="form-group" action="{{ URL::to('grade-action') }}" method="POST">
            <div class="row">
                <input type="hidden" name="homework-id" value="{{ $file->id }}">
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
@endif

<div class="card text-center">
    <div class="card-header">Adauga un comentariu</div>
    <div class="card-body">
        <div class="form-group">
            <form action="{{ \Illuminate\Support\Facades\URL::to('/file-comments-action') }}"
                  method="POST">
                {{ csrf_field() }}
                <input name="file-id" type="hidden" value="{{ $file->id }}">
                <textarea class="form-control" name="comments" id="" rows="2" style="width:100%"></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Posteaza</button>
            </form>
        </div>

    </div>
</div>
<br>


<!--COMMENTS TEST-->

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

@endsection