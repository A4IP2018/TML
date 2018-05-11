@extends('layouts.master')


@section('content')


<script>
    function  homework_submit()
	{
           
            document.location = "/add-homework";
    }
</script>



<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Homework</li>
    <li class="breadcrumb-item active">New Homework</li>
  </ol>
  <form action="/add-homework>" method="post">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="hw-title">Titlu:</label>
          <input type="text" name="homework_title" class="form-control" id="hw-title" placeholder="Alege un titlu">
        </div>
        <div class="form-group">
          <label for="sel1">Curs:</label>
          <select class="form-control" name="homework_course" id="hw-curssel">
            <option>IP fara Patrut :(</option>
            <option>Curs 2</option>
            <option>Curs 3</option>
            <option>Curs 4</option>
          </select>
        </div>
        <div class="form-group">
          <label for="hw-descr">Descriere:</label>
          <textarea class="form-control" name="homework_description" rows="5" id="hw-descr" placeholder="Alege o descriere"></textarea>
        </div>

        <div class="form-group row">
        <label for="example-date-input" class="col-1 col-form-label">Deadline:</label>
        <div class="col-10">
          <input class="form-control" name="homework_deadline" type="date" value="2018-08-19" id="example-date-input">
        </div>
        </div>

        <p>Format:
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="">.rar
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="">.zip
          </label>
        </div>
        <div class="form-check form-check-inline disabled">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="" disabled>disabled
          </label>
        </div>
        </p>
        <button type="submit" class="btn btn-primary" onsubmit="homework_submit()">Submit</button>
      </div>
    </div>
	</form>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection
