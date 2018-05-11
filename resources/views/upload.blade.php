@extends('layouts.master')


<!--UPLOAD HOMEWORK PAGE-->

@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Bord</a>
    </li>
    <li class="breadcrumb-item active">Upload</li>
  </ol>

      <div class="row">
        <div class="col-12">

            <blockquote class="blockquote text-center">
            <p class="mb-0">Upload</p>
            <footer class="blockquote-footer">acum ori niciodata</footer>
            </blockquote>

            <form action="/upload" method="post" enctype="multipart/form-data">
                Titlu tema:
                <br />
                <input name="homework-title" type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">

                <div class="form-group">

                <label for="sel1">Curs:</label>
                <select name="course-title" class="form-control" id="hw-curssel">

                  <option>IP fara Patrut :(</option>
                  <option>Curs 2</option>
                  <option>Curs 3</option>
                  <option>Curs 4</option>

                </select>

                </div>

                Fisiere tema (Poti atasa unul sau mai multe):
                <br />
                <input type="file" name="homework[]" multiple />
                <br /><br />
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>


        </div>
      </div>
    </div>
  </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

@endsection