@extends('layouts.master')

@section('content')

<!--single HOMEWORK UPLOAD PAGE-->

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



        <div class="card text-center">

          <!--homework course title-->
          <a href="{{ url('/course-sg') }}" class="card-header">PSGBD</a>

          <div class="card-body">

            <!--homework title-->
            <h5 class="card-title">Laboratorul 8</h5>

            <!--stud homework -->
            <p class="card-text"> Bla bla bla. Aceasta este o tema foarte faina.

            </p>


            <!--homework Content-->
            <hr><p class="card-text">Continut tema:</p>

            <!--homework uploaded files-->
            <div class="card-columns">

              <div class="card" style="width: 8rem;">
                <div class="card-header bg-transparent border">

              <div class="card-body">

                <!--homework file title-->
                <h6 class="card-subtitle mb-2 text-muted">index</h6>
                <!--homework file extension-->
                <p class="card-text">.txt</p>

              </div></div></div>


              <div class="card" style="width: 8rem;">
                <div class="card-header bg-transparent border">

                  <div class="card-body">

                    <!--homework file title-->
                    <h6 class="card-subtitle mb-2 text-muted">ex1</h6>
                    <!--homework file extension-->
                    <p class="card-text">.sql</p>

                  </div></div></div>



          </div>
          <!--date/time when posted-->
          <div class="card-footer text-muted">
            2 days ago
          </div>




            <hr>
            <!--Edit homework-->
            <a href="#" class="btn btn-secondary">Editeaza</a>

            <!--Grade homework-->
            <button type="button" class="btn btn-primary">Noteaza</button>

            <input type="number" name="grade-stud" style="width: 50px">

        <h1>Blank</h1>

         @if ($grade)
          <h1>Nota: {{ $grade->grade }}</h1>
        @endif
        
        <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>

        <form action="{{ URL::to('grade-action') }}" method="POST">
          <input type="hidden" name="homework-id" value="{{ $homework->id }}">
          <input type="hidden" name="user-id" value="{{ $user->id }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">


          <input type="text" name="grade">
          <button type="submit">Submit</button>
        </form>

      </div>
    </div>
  </div>
</div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->


  
@endsection