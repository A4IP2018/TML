@extends('layouts.master')


@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Homework-sg</li>
  </ol>
    <div class="row">
      <div class="col-12">
        <div class="progress">
            <!--deadline bar-->
            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            1 week left</div>
        </div>
        <!--homework AUTHOR-->
        <div class="card text-center">
        <a href="{{ url('/course-sg') }}" class="card-header">PSGBD</a>
        <div class="card-body">
            <h5 class="card-title">Laboratorul 8</h5>
            <p class="card-text">
               {{ $homework->description }}
            </p>
            <hr><p class="card-text">Format: .zip</p>
            <hr><p class="card-text">Deadline: 25 Mai 2018</p>
            <hr><p class="card-text">Autor: Cosmin Varlan</p>
            <hr>
            <a href="{{ url('/upload') }}" class="btn btn-primary">Upload</a>
            <a href="#" class="btn btn-primary">Reviews</a>
            <a href="#" class="btn btn-primary">Follow</a>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
        </div>


        </div>
    </div>
    </div>

    <div class="comment-section">
        <div class="container-fluid">

            <form action="{{ \Illuminate\Support\Facades\URL::to('/comments-action') }}" method="POST">
                {{ csrf_field() }}
                <input name="homework-id" type="hidden" value="{{ $homework->id }}">
                <textarea name="comments" id="" cols="30" rows="10"></textarea>

                <button type="submit btn-primary">Submit</button>
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