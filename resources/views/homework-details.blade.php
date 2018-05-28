@extends('layouts.master')


@section('content')

    <!--HOMEWORK SINGLE PAGE-->

    <?php
    $now = \Carbon\Carbon::now();
    $start = \Carbon\Carbon::parse($homework->created_at);
    $deadline = \Carbon\Carbon::parse($homework->deadline);

    $wholeDif = $deadline->diffInDays($start);

    if ($deadline < \Carbon\Carbon::now()) {
        $remainingDif = "termenul a expirat";
    }
    else {
        $remainingDif = $deadline->diffForHumans($now);
    }

    $realDiff = $deadline->diffInDays($now);
    if ($deadline < $now) {
        $realDiff = 0;
    }


    //$new_width = (($wholeDif - $remainingDif) / 100) * $wholeDif;

    ?>


<div class="row">
    <div class="col-6">
        <div class="{{ ($realDiff == 0) ? 'bg-secondary' : (($realDiff < 3) ? 'bg-danger' : (($realDiff < 5) ? 'bg-warning' : 'bg-primary')) }} text-white text-center">
            {{ $remainingDif }}
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
        </div>

        <div class="card text-center">
            <div class="card-header">Descriere</div>
            <div class="card-body ">
                <h5 class="card-title">{{ $homework->description }}</h5>
            </div>
        </div>
        <br>
        <div class="card text-center">
            <div class="card-header">Termen limit&#259;</div>
            <div class="card-body">
                <h5 class="{{ ($homework->deadline < Carbon\Carbon::now()) ? 'text-danger' : '' }}">{{ $homework->deadline }}</h5>
            </div>
        </div>
        <br>
        @if (is_course_teacher($homework->course->id))
        <div class="card text-center">
            <div class="card-body">
                <a class="btn btn-info" href="{{ url('/homework/' . $homework->slug . '/edit') }}">Editeaz&#259;</a>
            </div>
        </div>
        @endif

        @if (can_subscribe($homework->course->id))
            <div class="card text-center">
                <a href="{{ url('/course/' . $homework->course->slug) }}" class="btn btn-primary">Aboneaz&#259;-te la curs</a>
            </div>
        @endif

        <br>

        <div class="card text-center">
            <div class="card-header">Evenimente</div>
            <div class="card-body">
                <ul class="list-group">
                @foreach ($events as $event)
                        <li class="list-group-item">
                            {!! $event->event !!}
                        </li>
                @endforeach
                </ul>
            </div>
        </div>

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
                        @if ($comment->user->student_information)
                            <h6 class="card-title mb-1"><a
                                        href="#">{{ $comment->user->student_information->last_name }} {{ $comment->user->student_information->first_name }}</a>
                                <small> $comment->created_at</small>
                            </h6>

                        @else
                            <h6 class="card-title mb-1"><a
                                        href="#">{{ $comment->user->teacher_information->name }}</a>
                                <small> $comment->created_at</small>
                            </h6>

                        @endif
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

    @if($homework->deadline <= Carbon\Carbon::now() || !isAlreadyMarked($homework))
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
    @endif
</div>
@endsection