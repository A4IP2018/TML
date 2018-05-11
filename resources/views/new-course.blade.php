@extends('layouts.master')


@section('content')

<!--NEW COURSE PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Cursuri</li>
    <li class="breadcrumb-item active">Curs Nou</li>
  </ol>

    <div class="row">
      <div class="col-12">
        <div class="form-group">

          <!--Course title-->
          <label for="hw-title">Titlu:</label>
          <input name="course-title" type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">

        </div>

        <div class="form-group">

          <!--Course year-->
          <label for="sel1">An:</label>
          <select name="course-year" class="form-control" id="hw-curssel">

            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>Other</option>

          </select>

        </div>

        <div class="form-group">

          <!--Course semester-->
          <label for="sel1">Semestru:</label>
          <select name="course-sem" class="form-control" id="hw-curssel">

            <option>1</option>
            <option>2</option>
            <option>Other</option>

          </select>

        </div>

        <div class="form-group">
          
          <!--Course description-->
          <label for="hw-descr">Descriere:</label>
          <textarea name="course-descr" class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere">bla bla bla</textarea>
        
        </div>

        <div class="form-group">
          
          <!--Course teachers-->
          <label for="hw-descr">Profesori:</label>
          <textarea name="course-teach" class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere">bla bla bla</textarea>
        
        </div>

        <!--Submit Course-->
        <button name="course-create" type="submit" class="btn btn-primary">Salveaza</button>
        

      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection