@extends('layouts.master')


@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Courses</li>
    <li class="breadcrumb-item active">New Course</li>
  </ol>
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="hw-title">Titlu:</label>
          <input type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">
        </div>
        <div class="form-group">
          <label for="sel1">An:</label>
          <select class="form-control" id="hw-curssel">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="hw-descr">Descriere:</label>
          <textarea class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection