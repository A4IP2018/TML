@extends('layouts.master')


@section('content')

    <!--HOMEWORK SINGLE PAGE-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Bord</a>
                </li>
                <li class="breadcrumb-item active">Tema</li>
            </ol>
            <div class="row">
                <div class="col-12">

                    <div class="progress">

                      <?php
                            $now = \Carbon\Carbon::now();
                            $start = \Carbon\Carbon::parse($homework->created_at);
                            $deadline = \Carbon\Carbon::parse($homework->deadline);

                            $wholeDif = $deadline->diffInDays($start);

                            $remainingDif = $deadline->diffInDays($now);

                          $new_width = (($wholeDif - $remainingDif) / 100) * $wholeDif;

                      ?>

                        <!--deadline time left bar-->
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $new_width . '%' ?>;"  aria-valuenow="{{ $wholeDif - $remainingDif }} "
                             aria-valuemin="0" aria-valuemax="{{ $wholeDif }}">
                            {{ $remainingDif }} zile ramase
                        </div>

                    </div>

                    <div class="card text-center">

                        <!--homework course title-->
                        <a href="{{ url('/course-sg') }}" class="card-header">{{ $homework->course->course_title }}</a>

                        <div class="card-body">

                            <!--homework title-->
                            <h5 class="card-title">{{ $homework->name }}</h5>

                            <!--homework description-->
                            <p class="card-text">
                                {{ $homework->description }}
                            </p>

                            <!--homework format-->
                            <hr>
                            <p class="card-text">Formate acceptate:

                                @foreach($homework->formats as $format)

                                    <span style="color: blue;">{{ $format->extension_name }}</span>

                                @endforeach

                            </p>

                            <!--homework deadline-->
                            <hr>
                            <p class="card-text">Termen limita: {{ $homework->deadline }}</p>

                            <!--homework author-->
                            <hr>
{{--                            <p class="card-text">Autor: {{ $homework->user->teacher_information->name }}</p>--}}
                            <hr>

                            <!--upload to this homework-->
                            <a href="{{ url('/upload/' . $homework->slug) }}" class="btn btn-primary">Upload
                                Rezolvare</a>

                            <!--add members to this homework <TEACHER>-->
                            <a href="#" class="btn btn-primary">Adauga membri</a>

                        </div>
                        <!--date/time when posted-->
                        <div class="card-footer text-muted">
                            2 days ago
                        </div>


                        <br>
                        <!--homework title-->
                        <div class="comment-section">
                            <div class="container-fluid">

                                <form action="{{ \Illuminate\Support\Facades\URL::to('/comments-action') }}"
                                      method="POST">

                                    {{ csrf_field() }}

                                    <input name="homework-id" type="hidden" value="{{ $homework->id }}">

                                    <textarea name="comments" id="" rows="2" cols="110"
                                              style="outline: none;border:2px solid #8eb4cb;border-radius: 5px"></textarea>

                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Posteaza</button>
                                    </div>

                                </form>
                            </div>

                        </div>

                    </div>
                    <br>
                    <hr>

                    <!--COMMENTS TEST-->

                    @if ($comments)
                        @foreach($comments as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title mb-1"><a href="#">{{ $comment->user->student_information->last_name }} {{ $comment->user->student_information->first_name }}</a></h6>
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
            </div>
        </div>
    </div>





    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@endsection