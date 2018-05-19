@extends('layouts.master')


@section('content')

<!--NEW COURSE PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
    <div class="errors">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Cursuri</li>
    <li class="breadcrumb-item active">Curs Nou</li>
  </ol>

    <div class="row">
      <div class="col-12">
        <form action="{{ url('/course') }}" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <!--Course title-->
            <label for="hw-title">Titlu:</label>
            <input name="course_title" type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">
          </div>

          <div class="form-group">
            <!--Course year-->
            <label for="year_select">An:</label>
            <input name="year_select" type="number" min="1" max="6" class="form-control" id="hw-year" placeholder="Alege anul cursului">
          </div>


          <div class="form-group">
            <!--Course semester-->
            <label for="semester_select">Semestru:</label>
            <input name="semester_select" type="number" min="1" max="2" class="form-control" id="hw-semester" placeholder="Alege semestrul cursului">
          </div>


          <div class="form-group">

            <!--Course description-->
            <label for="hw-descr">Descriere:</label>
            <textarea name="course_descr" class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere"></textarea>

          </div>

          <div class="form-group">
            <!--Course teachers-->
            <label for="hw-descr">Profesori:</label>
            <textarea name="course_teach" class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere"></textarea>
          </div>

          <!--Submit Course-->
          <button name="course-create" type="submit" class="btn btn-primary">Salveaza</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection