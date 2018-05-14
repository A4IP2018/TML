@extends('layouts.master')

@section('content')

<!--MULTIPLE HOMEWORK UPLOADS PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Teme</a>
      </li>
    </ol>


    <div class="row">
      <div class="col-12">
        @foreach($files as $file)
        <!-- Example Homework Card-->
          <div class="card mb-3">
            <div class="card-header">{{ $file->file_name }}</div>

            <div class="card-body">

              <!--Homework title-->
              <h5 class="card-title">{{ $file->homework->course->course_title }}</h5>

              <!--Homework description-->
              <p class="card-text">{{ $file->homework->name }}</p>

            </div>

            <div class="card-footer bg-transparent border">
            <!--go to homework page-->
              <a href="{{ url('/upload/' . $file->file_name ) }}" class="btn btn-info">Detalii</a>
              <!--Grade homework-->
              <button type="button" class="btn btn-primary">Noteaza</button>
              <input type="number" name="grade-stud" style="width: 50px">
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>

  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->


  
@endsection