@extends('layouts.master')


@section('content')

<!--COURSE EDIT PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Cursuri</li>
    <li class="breadcrumb-item active">Editeaza Curs</li>
  </ol>

    <div class="row">
      <div class="col-12">
        <div class="form-group">

          <!--Course title edit-->
          <label for="hw-title">Titlu:</label>
          <input name="course_title" type="text" class="form-control" id="hw-title" placeholder="{{ $course->course_title }}">

        </div>

        <div class="form-group">
          <!--Course year edit-->
          <label for="year_select">An:</label>
          <input name="year_select" type="number" min="1" max="6" class="form-control" id="hw-year" placeholder="{{ $course->year }}">
        </div>


        <div class="form-group">
          <!--Course semester edit-->
          <label for="semester_select">An:</label>
          <input name="semester_select" type="number" min="1" max="2" class="form-control" id="hw-semester" placeholder="{{ $course->semester }}">
        </div>

        <div class="form-group">
          
          <!--Course description edit-->
          <label for="course-descr">Descriere:</label>
          <textarea name="course-descr" class="form-control" rows="5" id="hw-descr" placeholder="{{ $course->description }}"></textarea>
        
        </div>

        <div class="form-group">
          
          <!--Course teachers edit-->
          <label for="course-teach">Profesori:</label>
          <textarea name="course-teach" class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere">{{ join(', ', $course->users->pluck('username')->toArray()) }}</textarea>
        
        </div>

        <!--Submit Course edit-->
        <button name="course-edit" type="submit" class="btn btn-primary">Salveaza</button>

        <!--Delete Course-->
        <button name="course-del" type="submit" class="btn btn-primary">Sterge</button>

        <!--Cancel edit-->
        <a href="{{ url('/courses') }}" class="btn btn-secondary">Inapoi</a>
        

      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection