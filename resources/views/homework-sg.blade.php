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
        </div>


        </div>
    </div>
    </div>

    <!--homework title-->
    <div class="comment-section">
        <div class="container-fluid">

            <form action="{{ \Illuminate\Support\Facades\URL::to('/comments-action') }}" method="POST">
                {{ csrf_field() }}
                <input name="homework-id" type="hidden" value="{{ $homework->id }}">
                <textarea name="comments" id="" cols="30" rows="10"></textarea>

                <button type="submit btn-primary">Posteaza</button>
            </form>






        </div>


        <div class="comments-wrapper">
            @foreach($comments as $comment)

                {{ $comment->comment }}

                <br><br>

            @endforeach
        </div>

    </div>

</div>





<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection