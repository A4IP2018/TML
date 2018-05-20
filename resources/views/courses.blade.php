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
                          <button data-toggle="collapse" data-target="#demo" class="btn btn-secondary">Filtru <i class="fa fa-filter"></i></button>

                          <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                          </button>
                      </span>
          </div>
          <div id="demo" class="collapse">
            <div class="card">
                <div class="card-body">            
                  <form>
                    <h6>An:&nbsp; </h6>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio"> 1
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio"> 2
                        </label>
                     </div>
                     <div class="form-check form-check-inline">
                         <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio" > 3
                         </label>
                     </div>
                </form>
<hr>
                    <form>
                      <h6>Semestru:&nbsp; </h6>
                        <div class="form-check form-check-inline">
                         <label class="form-check-label">
                           <input type="radio" class="form-check-input" name="optradio"> 1
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio"> 2
                        </label>
                     </div>
                </form>
<hr>
                <form>
                  <h6>Abonament:&nbsp; </h6>
                    <div class="form-check form-check-inline">
                      <label class="form-check-label">
                       <input type="radio" class="form-check-input" name="optradio"> Da
                      </label>
                   </div>
                   <div class="form-check form-check-inline">
                      <label class="form-check-label">
                       <input type="radio" class="form-check-input" name="optradio"> Nu
                      </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optradio"> Toate
                    </label>
                  </div>
              </form>
        </div>
      </div>
  </div>

      @if (Auth::check() and is_teacher(Auth::id()))
        <!--Press to create new Course-->
        <br><a href="{{ url('/course/create') }}" class="btn btn-primary btn-lg btn-block">Curs nou</a>
      @endif
      <!--Multiple Courses-->
      <div class="mb-0 mt-4">

        <div class="card-columns">
        @foreach ($courses as $course)
        <!-- Example Course Card-->
          <form action = "{{ url('/course/' . $course->slug . '/subscribe') }}" method = "POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card mb-3">
              <div class="card-body text">
                <!--Course title-->
                <h5 class="card-title">{{ $course->course_title }}</h5>
                <!--Course year-->
                <p class="card-text">An: {{ $course->year }}</p>
                <!--Course semester-->
                <p class="card-text">Semestru: {{ $course->semester }}</p>

                <p class="card-text">Description: {{ $course->description }}</p>
              </div>
              <div class="card-footer bg-transparent border">

                <!--press to be sent to the course page-->
                <a href="{{ url('/course/' . $course->slug) }}"><button type="button" class="btn btn-info">Detalii</button></a>


                <!--press to follow course-->
                @if (!in_array(Auth::id(), $course->subscriptions->pluck('id')->toArray()))
                  <button type="submit" href="" class="btn btn-primary">Aboneaza-te</button>
                @endif

                @if (in_array(Auth::id(), $course->users->pluck('id')->toArray()))
                  <a href="{{ url('/course/' . $course->slug . '/edit') }}" class="btn btn-secondary">Editeaza</a>;
                @endif

              </div>
            </div>
          </form>

        @endforeach
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