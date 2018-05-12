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
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ URL::to('upload-action') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="homework-id" value="{{ $homework->id }}">
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

                Fisiere tema :
                <br />
                <input type="file" name="fileToUpload" />
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