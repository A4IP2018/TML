@extends('layouts.master')


@section('content')

<!--COURSE SINGLE PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Curs</li>
  </ol>

    <div class="row">
      <div class="col-12">

        <div class="card text-center">

          <div class="card-body">

          <!--Course title-->
          <h5 class="card-title">{{ $course->course_title }}</h5>

          <!--Course year-->
          <hr><p class="card-text">An: {{ $course->year }}</p>

          <!--Course semester-->
          <hr><p class="card-text">Semestru: {{ $course->semester }}</p>

          <!--Course credits-->
          <hr><p class="card-text">Credite: {{ $course->credits }}</p>

          <!--Course teachers-->
          <hr>
          <p class="card-text">Profesori: {{ $teachers_string }}</p>
          <hr>

          <!--Course description-->
          <hr><p class="card-text">Description: {{ $course->description }}</p><hr>

            <!--press to follow course-->
            @if (!in_array(Auth::id(), $course->subscriptions->pluck('id')->toArray()))
              <button type="submit" href="" class="btn btn-primary">Aboneaza-te</button>
            @endif

            @if (in_array(Auth::id(), $course->users->pluck('id')->toArray()))
              <a href="{{ url('/course/' . $course->slug . '/edit') }}" class="btn btn-secondary">Editeaza</a>;
            @endif

        </div>

        <!--date/time when posted-->
        <div class="card-footer text-muted">
          {{ $elapsed_time }}
        </div>

      </div>


    </div>
</div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection