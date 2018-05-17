@extends('layouts.master')


@section('content')

<!--DASHBOARD PAGE-->

<div class="content-wrapper">
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
  </ol>
  <!-- Icon Cards-->
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-comments"></i>
          </div>
          <div class="mr-5">26 Mesaje noi!</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ url('/messages') }}">
          <span class="float-left">Citeste mai mult</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
          </div>
          <div class="mr-5">11 Teme noi!</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ url('/homework') }}">
          <span class="float-left">Citeste mai mult</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-exclamation-triangle"></i>
              </div>
              <div class="mr-5">Tema de predat curand!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ url('/deadlines') }}">
              <span class="float-left">Citeste mai mult</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
  </div>
  <!-- Card Columns Example Social Feed-->

  {{--NOUTATI--}}
  <div class="row">
    <div class="mb-0 mt-4 ml-4">
      <i class="fa fa-newspaper-o"></i> Noutăți
    </div>
  </div>
  <div class="row">
    <hr class="mb-2" style="width:100%">
    <div class="col-sm-6">
      <div class="card-header">
        <i class="fa"></i>Teme noi</div>
      <div class="list-group list-group-flush small" style="height:250px; overflow-y:scroll">
        <a class="list-group-item list-group-item-action" href="#">
          <div class="media">
            <div class="media-body">
              <strong>Tema nou adaugata</strong>
              <div class="text-muted smaller">Adaugata acum 5m</div>
            </div>
          </div>
        </a>

      </div>
      <div class="card-footer small text-muted">Ultima modificare 11:59 PM</div>
    </div>
  </div> <!--/.row-->
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection