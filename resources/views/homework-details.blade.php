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

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Bord</a>
                </li>
                <li class="breadcrumb-item active">Tema (postata {{ ($now->diffInDays($start) == 0) ? "azi" : "zile in urma" }})</li>
            </ol>
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

                    @if (!in_array(Auth::id(), $homework->course->subscriptions->pluck('id')->toArray()))
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

                <div class="col-6">
                    <div class="mb-0 mt-4">
                        <i class="fa fa-newspaper-o"></i> Incarcare tema</div>
                    <hr class="mt-2">

                    <p class="card-text">Formate acceptate:
                        @foreach($homework->formats as $format)
                            <span style="color: blue;">{{ $format->extension_name }}</span>
                        @endforeach
                    </p>

                    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="homework-id" value="{{ $homework->id }}">
                        <br/>
                        <p>Fisiere tema :</p>
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="input-group" style="width: fit-content">
                            <div class="custom-file">
                                <input name="fileToUpload" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="fileToUpload">Incarca</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Upload</button>
                            </div>
                        </div>

                        <br>
                    </form>

                    @if (Auth::check() and Auth::user()->files->count() > 0)
                        <div class="card text-center">
                            <ul class="list-group list-group-flush">
                            @foreach (Auth::user()->files as $file)
                                @if ($file->homework->id == $homework->id)
                         <!--homework uploaded files-->
                                <li class="list-group-item"><a href="{{ url('/upload/' . $file->file_name) }}">{{ $file->file_name }}</a></li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@endsection