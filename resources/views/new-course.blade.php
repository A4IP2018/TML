@extends('layouts.master')


@section('content')


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

      @if ($teachers->count() > 0)
      <div class="form-group">
        <!--Course teachers-->
        <label for="hw-descr">Al&#539;i profesori:</label>
        <br>
        @foreach ($teachers as $teacher)
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="teacher_checkbox[]" value="{{ $teacher->id }}" type="checkbox"/>
            <label class="form-check-label">{{ $teacher->teacher_information->name }}</label>
          </div>
        @endforeach
      </div>
      @endif

      <!--Submit Course-->
      <button name="course-create" type="submit" class="btn btn-primary">Salveaza</button>
    </form>
  </div>
</div>


@endsection