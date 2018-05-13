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

            @if ($file->user && $file->user->student_information)
              <div class="card-header bg-transparent border"><a href="{{ url('/profile') }}">{{ $file->user->student_information->last_name }} {{ $file->user->student_information->first_name }}</a></div>
            @endif

            <div class="card-body text">
              
              <!--Homework title-->
              <h5 class="card-title">{{ $file->homework->name }}</h5>

              <!--Homework description-->
              <p class="card-text">{{ $file->homework->name }}</p>

            </div>
            
            <div class="card-footer bg-transparent border">


            <!--go to homework page-->
              <a href="{{ url('/stud-uploads/' . $file->user_id .'/' . $file->homework->slug ) }}" class="btn btn-info">Detalii</a>
          </div>

          </div>
        @endforeach

      </div>
    </div>
  </div>

  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->


  
@endsection