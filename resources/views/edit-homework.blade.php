@extends('layouts.master')


@section('content')

<!--EDIT HOMEWORK page-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Teme</li>
    <li class="breadcrumb-item active">Editare Tema</li>
  </ol>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row">
      <div class="col-12">
        <form  action="{{ url('homework/'. $homework->slug) }}" method="POST">
          {{ method_field('PUT') }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">



          <label for="hw-title">Titlu:</label>

          <!--Homework title edit-->
          <input name="name" type="text" class="form-control" id="hw-title" value="{{ $homework->name }}">

        </div>
        <div class="form-group">

          <label for="sel1">Curs:</label>
          <select class="form-control" name="course" id="hw-curssel">
            @if ($teacherCourses)
              @foreach($teacherCourses as $teacherCours)
                <option {{ $teacherCours->id == $homework->course->id ? 'selected' : '' }} value="{{ $teacherCours->id }}">{{ $teacherCours->course_title }}</option>
              @endforeach
            @endif
          </select>

        </div>
        <div class="form-group">
          
          <label for="hw-descr">Descriere:</label>
          
          <!--Homework description edit-->
          <textarea name="description" class="form-control" rows="5" id="hw-descr">{{ $homework->description }}</textarea>
        
        </div>

        <div class="form-group row">

        <label for="example-date-input" class="col-1 col-form-label">Termen limita:</label>

        <!--Homework deadline edit-->
        <div class="col-10">
          <input name="deadline" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($homework->deadline)->toDateString() }}" id="example-date-input">
        </div>
        </div>

        <!--Homework format edit-->
        <p>Format:

        @if ($formats)
          @foreach ($formats as $format)
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input {{ in_array($format->id, $homework->formats->pluck('id')->toArray()) ? 'checked' : '' }} name="format[]" type="checkbox" class="form-check-input"
                       value="{{ $format->id }}">
                {{ $format->extension_name }}
              </label>
            </div>
          @endforeach
        @endif

        </p>



        

        <!--Homework EDIT-->
        <button name="homework-edit" type="submit" class="btn btn-primary">Salveaza</button>
        
        <!--Homework DELETE-->
        <button name="homework-delete" type="submit" class="btn btn-primary">Sterge</button>

        <!--cancel edit-->
        <a href="{{ url('/homework') }}" class="btn btn-secondary">Cancel</a>

        </form>

      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection