@extends('layouts.master')


@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Courses</li>
  </ol>
    <div class="row">
      <div class="col-12">

    <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for course...">
      <span class="input-group-append">
      <button class="btn btn-primary" type="button">
      <i class="fa fa-search"></i>
      </button>
      </span>
    </div>

      <br><a href="{{ url('/new-course') }}" class="btn btn-primary btn-lg btn-block">New Course</a>

      <div class="mb-0 mt-4">

        <i class="fa fa-newspaper-o"></i> ...</div>
        <hr class="mt-2">
        <div class="card-columns">
        <!-- Example Homework Card-->
          <div class="card mb-3">
            <div class="card-header bg-transparent border">Materie</div>
            <div class="card-body text">
              <h5 class="card-title">...</h5>
              <p class="card-text">...</p>
            </div>
            <div class="card-footer bg-transparent border">
            <a href="{{ url('/course-sg') }}"><button type="button" class="btn btn-info">Detalii</button></a>
            <a href="{{ url('/reviews') }}" class="btn btn-primary">Reviews</a>
            <a href="#" class="btn btn-primary">Follow</a>
          </div>
        </div>

      </div>

        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">4</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>

      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection