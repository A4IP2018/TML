@extends('layouts.master')


@section('content')

<!--NEW HOMEWORK page-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Teme</li>
    <li class="breadcrumb-item active">Tema Noua</li>
  </ol>

    <div class="row">
      <div class="col-12">

        <div class="form-group">

          <label for="hw-title">Titlu:</label>

          <!--Homework title-->
          <input name="homework-title" type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">

        </div>
        <div class="form-group">

          <label for="sel1">Curs:</label>

          <!--Homework Course-->
          <select name="course-title" class="form-control" id="hw-curssel">

            <option>IP fara Patrut :(</option>
            <option>Curs 2</option>
            <option>Curs 3</option>
            <option>Curs 4</option>

          </select>

        </div>
        <div class="form-group">
          
          <label for="hw-descr">Descriere:</label>
          
          <!--Homework description-->
          <textarea class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere"></textarea>
        
        </div>

        <div class="form-group row">

        <label for="example-date-input" class="col-1 col-form-label">Termen limita:</label>

        <!--Homework deadline-->
        <div class="col-10">
          <input name="homework-deadline" class="form-control" type="date" value="2018-08-19" id="example-date-input">
        </div>
        </div>

        <!--Homework format-->
        <p>Format:

        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input name="format-check" type="checkbox" class="form-check-input" value="">.rar
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input name="format check" type="checkbox" class="form-check-input" value="">.zip
          </label>
        </div>
        <div class="form-check form-check-inline disabled">
          <label class="form-check-label">
            <input name="format-check" type="checkbox" class="form-check-input" value="" disabled>disabled
          </label>
        </div>

        </p>





        <!--Homework submit-->
        <button type="submit" class="btn btn-primary">Salveaza</button>




      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection