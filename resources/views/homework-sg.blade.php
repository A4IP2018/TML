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

            <!--deadline time left bar-->
            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            1 week left</div>

        </div>
        
        <div class="card text-center">

        <!--homework course title-->
        <a href="{{ url('/course-sg') }}" class="card-header">PSGBD</a>

        <div class="card-body">

            <!--homework title-->
            <h5 class="card-title">Laboratorul 8</h5>

            <!--homework description-->
            <p class="card-text">
               {{ $homework->description }}
            </p>

            <!--homework format-->
            <hr><p class="card-text">Format: .zip</p>
            
            <!--homework deadline-->
            <hr><p class="card-text">Termen limita: 25 Mai 2018</p>

            <!--homework author-->
            <hr><p class="card-text">Autor: Cosmin Varlan</p><hr>

            <!--upload to this homework-->
            <a href="{{ url('/upload') }}" class="btn btn-primary">Upload</a>

            <!--add members to this homework <TEACHER>-->
            <a href="#" class="btn btn-primary">Adauga membri</a>

            
            <!--student uploads for this homework <TEACHER>-->
            <a href="{{ url('/stud-uploads') }}" class="btn btn-secondary">Uploads</a>

        </div>
        <!--date/time when posted-->
        <div class="card-footer text-muted">
            2 days ago
        </div>


    <br>
    <!--homework title-->
    <div class="comment-section">
        <div class="container-fluid">

            <form action="{{ \Illuminate\Support\Facades\URL::to('/comments-action') }}" method="POST">

                {{ csrf_field() }}

                <input name="homework-id" type="hidden" value="{{ $homework->id }}">

                <textarea name="comments" id="" rows="2" cols="110" style="border:2px solid #8eb4cb;border-radius: 12px"></textarea>

            </form>
        </div>

    </div>

            <div class="card-body">
            <button type="submit" class="btn btn-primary">Posteaza</button>
            </div>


        </div>


          <br><hr>



          <!--COMMENTS TEST-->
          <div class="card mb-3">
              <div class="card-body">
                  <h6 class="card-title mb-1"><a href="#">Batman</a></h6>
                  <p class="card-text small">I don't know how to solve these...
                  </p>
              </div>
              <hr class="my-0">
          </div>

          <div class="card mb-3">
              <div class="card-body">
                  <h6 class="card-title mb-1"><a href="#">Spuderman</a></h6>
                  <p class="card-text small">LOL
                  </p>
              </div>
              <hr class="my-0">
          </div>
          <!--END COMENNTS TEST-->




        <div class="comments-wrapper">
            @foreach($comments as $comment)

                <div class="card mb-3">
                    <div class="card-body">

                        <!--SOMEONE'S NAME-->
                        <h5 class="card-title mb-1"><a href="{{ url('/profile') }}">Traian Basescu</a></h5>
                        <!--someone's last comment-->
                        <p class="card-text small">

                            {{ $comment->comment }}

                        </p>
                    </div>
                    <hr class="my-0">
                </div>

                <br>

            @endforeach
        </div>



          <br>

    </div>
    </div>
    </div>
  </div>





<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection