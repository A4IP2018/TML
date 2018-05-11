@extends('layouts.master')


@section('content')

<!--MULTIPLE COURSES PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Cursuri</li>
  </ol>
    <div class="row">
      <div class="col-12">

    <div class="input-group">

      <!--Course search-->
      <input name="course-search" class="form-control" type="text" placeholder="Cauta curs...">

      <span class="input-group-append">
      <button class="btn btn-primary" type="button">
      <i class="fa fa-search"></i>
      </button>

      </span>
    </div>

      <!--Press to create new Course-->
      <br><a href="{{ url('/new-course') }}" class="btn btn-primary btn-lg btn-block">Curs nou</a>


      <!--Multiple Courses-->
      <div class="mb-0 mt-4">

        <i class="fa fa-newspaper-o"></i> ...</div>
        <hr class="mt-2">
        <div class="card-columns">

        <!-- Example Course Card-->
          <div class="card mb-3">
            

            <div class="card-body text">

              <!--Course title-->
              <h5 class="card-title">Titlu Materie</h5>

              <!--Course year-->
              <p class="card-text">An:</p>
              
              <!--Course semester-->
              <p class="card-text">Semestru:</p>

            </div>
            <div class="card-footer bg-transparent border">

            <!--press to be sent to the course page-->
            <a href="{{ url('/course-sg') }}"><button type="button" class="btn btn-info">Detalii</button></a>

            <!--press to follow course-->
            <a href="#" class="btn btn-primary">Urmareste</a>

            <a href="{{ url('/edit-course') }}" class="btn btn-secondary">Editeaza</a>





          </div>
        </div>

      </div>
          <!--pagination-->

        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Inapoi</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">Inainte</a></li>
        </ul>

      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection