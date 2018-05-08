@extends('layouts.master')


@section('content')

<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1>Upload</h1>
      <div class="form-group">
        <label for="hw-title">Titlu:</label>
        <input type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">
      </div>
      <div class="form-group">
        <label for="sel1">Curs:</label>
        <select class="form-control" id="hw-curssel">
          <option>IP fara Patrut :(</option>
          <option>Curs 2</option>
          <option>Curs 3</option>
          <option>Curs 4</option>
        </select>
      </div>
      <div class="form-group">
        <label for="hw-descr">Descriere:</label>
        <textarea class="form-control" rows="5" id="hw-descr" placeholder="Alege o descriere"></textarea>
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
      <button type="submit" class="btn btn-primary">Upload</button>
    </div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

@endsection