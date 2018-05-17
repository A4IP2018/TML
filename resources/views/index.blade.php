@extends('layouts.master')


@section('content')

  <!--DASHBOARD PAGE-->

  <style>
    .overlay {
      position: absolute;
      bottom: 0;
      left: 100%;
      right: 0;
      background-color: rgb(220, 53, 69);
      overflow: hidden;
      width: 0;
      height: 100%;
      transition: .5s ease;
    }

    .cutie:hover .overlay {
      width: 100%;
      left: 0;
    }
  </style>
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
                <i class="fa fa-fw fa-bell-o"></i>
              </div>
              <div class="mr-5">26 Notificări noi!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ url('/notifications') }}">
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
            <div class="card text-white bg-danger o-hidden h-100 cutie" >
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fa fa-fw fa-exclamation-triangle"></i>
                    </div>
                    <div class="mr-5">Tema de predat curand!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Citeste mai mult</span>
                    <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
                <div class="overlay">
                    <div class="card-body">
                        <div class="bg-danger">
                            <div class="mr-5" style="white-space: nowrap;">Titlu tema urgenta</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100 cutie" style="background-color: #343a40;">
                  <div class="card-body">
                      <div class="card-body-icon">
                          <i class="fa fa-fw fa-balance-scale"></i>
                      </div>
                      <div class="mr-5">Motivație</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                      {{--<span class="float-left">Citeste mai mult</span>--}}
                      <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                  <div class="overlay" style="background-color: #343a40;">
                      <div class="card-body" style="background-color: #343a40;">
                          <div class="mr-5" style="white-space: nowrap;background-color: #343a40;">
                              <div class="mr-5 smaller" style="white-space: nowrap;">
                                  Tăria minţii vine prin exerciţiu şi nu prin repaos.
                                  <br>
                                  -Alexander Pope
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div> <!--/.row-->
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
            <i class="fa fa-magic"></i>Cufărul cu teme</div>
          <div class="list-group list-group-flush small" style="height:250px; overflow-y:scroll">
            <a class="list-group-item list-group-item-action" href="#">
              <div class="media">
                <div class="media-body">
                  <strong>Ultima tema postata</strong>
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