@extends('layouts.master')


@section('content')

    <!--HOMEWORK SINGLE PAGE-->

    <?php
    $now = \Carbon\Carbon::now();
    $start = \Carbon\Carbon::parse($homework->created_at);
    $deadline = \Carbon\Carbon::parse($homework->deadline);

    $wholeDif = $deadline->diffInDays($start);

    $remainingDif = $deadline->diffInDays($now);

    $new_width = (($wholeDif - $remainingDif) / 100) * $wholeDif;

    ?>

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
<div class="row">
    <div class="col-6">
        <div class="progress">
            <!--deadline time left bar-->
            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $new_width . '%' ?>;"  aria-valuenow="{{ $wholeDif - $remainingDif }} "
                 aria-valuemin="0" aria-valuemax="{{ $wholeDif }}">
                {{ $remainingDif }} zile ramase
            </div>
        </div>
        <br>

        <div class="card-group">
            <div class="card mb-3 text-center">
                <div class="card-header">Tema</div>
                <div class="card-body ">
                    <h5 class="card-title">{{ $homework->name }}</h5>
                </div>
            </div>

            @if ($homework->course)
                <div class="card mb-3 text-center">
                    <div class="card-header">Curs</div>
                    <div class="card-body ">
                        <h5><a href="{{ url('/course/' . $homework->course->slug) }}">{{ $homework->course->course_title }}</a></h5>
                    </div>
                </div>
            @endif

            @if ($homework->category)
                <div class="card mb-3 text-center">
                    <div class="card-header">Categorie</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $homework->category->name }}</h5>
                    </div>
                </div>
            @endif
        </div>

        <div class="card text-center">
            <div class="card-header">Descriere</div>
            <div class="card-body ">
                <h5 class="card-title">{{ $homework->course->description }}</h5>
            </div>
        </div>
        <br>
        <div class="card text-center">
            <div class="card-header">Termen limita</div>
            <div class="card-body">
                <h5 class="card-title">{{ $homework->deadline }}</h5>
            </div>
        </div>

        @if (can_subscribe($homework->course->id))
            <div class="card text-center">
                <a href="{{ url('/course/' . $homework->course->slug) }}" class="btn btn-primary">Aboneaza-te la curs</a>
            </div>
        @endif

        <br>
        <div class="card text-center">
            <div class="card-header">Adauga un comentariu</div>
            <div class="card-body">
                <div class="form-group">
                <form action="{{ \Illuminate\Support\Facades\URL::to('/comments-action') }}"
                      method="POST">
                    {{ csrf_field() }}
                    <input name="homework-id" type="hidden" value="{{ $homework->id }}">
                    <textarea class="form-control" name="comments" id="" rows="2" style="width:100%"></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary">Posteaza</button>
                </form>
                </div>

            </div>
        </div>
        <br>

        <!--COMMENTS TEST-->

        @if ($comments)
            @foreach($comments as $comment)
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


        <br>

    </div>

    <div class="col-6">
        <div class="mb-0 mt-4">
            <i class="fa fa-newspaper-o"></i> Incarcare tema</div>
        <hr class="mt-2">


        <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="homework-id" value="{{ $homework->id }}">
            <br/>
            <p>Fisiere tema :</p>

            <div class="card-columns">
                <?php $counter = 0; ?>
                @foreach ($homework->requirements as $requirement)
                    <div class="card">
                        <div class="card-header">{{ $requirement->description }}</div>
                        <div class="card-body">
                            <div class="custom-file">
                                <input name="toUpload[{{ $counter }}][upload_file]" type="file" class="custom-file-input">
                                <input name="toUpload[{{ $counter }}][requirement_id]" type="hidden" value="{{ $requirement->id }}">
                                <label class="custom-file-label" for="toUpload{{ $counter }}">Incarca</label>
                            </div>
                        </div>
                        <div class="card-footer">Formatul necesar: {{ $requirement->format->extension_name }}</div>
                    </div>
                    <?php $counter++; ?>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary" class="form-control">Incarca!</button>
        </form>
    </div>
</div>
@endsection