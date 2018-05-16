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
            <i class="fa fa-fw fa-sticky-note"></i>
          </div>
          <div class="mr-5">26 Notificari noi!</div>
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
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-exclamation-triangle"></i>
              </div>
              <div class="mr-5">Termene limita teme!</div>
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
      <div class="mb-0 mt-4">
        <i class="fa fa-newspaper-o"></i> Noutati</div>
      <hr class="mt-2">


      <div class="card-columns">
        <!-- Example Social Card-->
        <div>
            <h4> Last homework commented </h4>

            <div class="card mb-3">
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#"> Homework title </a></h6>
                <p class="card-text small">
                    Homework description
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
              </div>
              <hr class="my-0">
              <div class="card-body small bg-faded">
                <div class="media">
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"><a href="#">Comment author name</a></h6>

                    Comment content
                    </div>
                  </div>
                </div>
              <div class="card-footer small text-muted">Posted 32 mins ago</div>
            </div>
        </div>

        <div>
            <h4> New homework added </h4>

            <div class="card mb-3">
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#"> Homework title </a></h6>
                <p class="card-text small">
                    Homework description
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
              </div>
              <div class="card-footer small text-muted">Posted 32 mins ago</div>
            </div>
        </div>

        <div>
            <h4> First deadline </h4>

            <div class="card mb-3">
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#"> Homework title </a></h6>
                <p class="card-text small">
                    Homework description
                </p>
              </div>
              <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#"> See deadline </a>
              </div>
              <div class="card-footer small text-muted">Posted 32 mins ago</div>
            </div>
        </div>
      </div>
      <!-- /Card Columns-->
    </div>
    <div class="col-lg-4">

      <!-- Example Notifications Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bell-o"></i> Feed Example</div>
        <div class="list-group list-group-flush small">
          <a class="list-group-item list-group-item-action" href="#">
            <div class="media">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
              <div class="media-body">
                <strong>David Miller</strong>posted a new article to
                <strong>David Miller Website</strong>.
                <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
              </div>
            </div>
          </a>
          <a class="list-group-item list-group-item-action" href="#">
            <div class="media">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
              <div class="media-body">
                <strong>Samantha King</strong>sent you a new message!
                <div class="text-muted smaller">Today at 4:37 PM - 1hr ago</div>
              </div>
            </div>
          </a>
          <a class="list-group-item list-group-item-action" href="#">
            <div class="media">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
              <div class="media-body">
                <strong>Jeffery Wellings</strong>added a new photo to the album
                <strong>Beach</strong>.
                <div class="text-muted smaller">Today at 4:31 PM - 1hr ago</div>
              </div>
            </div>
          </a>
          <a class="list-group-item list-group-item-action" href="#">
            <div class="media">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
              <div class="media-body">
                <i class="fa fa-code-fork"></i>
                <strong>Monica Dennis</strong>forked the
                <strong>startbootstrap-sb-admin</strong>repository on
                <strong>GitHub</strong>.
                <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
              </div>
            </div>
          </a>
          <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
  </div>

</div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection