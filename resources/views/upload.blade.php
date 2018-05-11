@extends('layouts.master')


@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Upload</li>
  </ol>
      <div class="row">
        <div class="col-12">

            <blockquote class="blockquote text-center">
            <p class="mb-0">Upload</p>
            <footer class="blockquote-footer">now or never</footer>
            </blockquote>
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="/upload" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                Homework title:
                <br />
                <input type="text" class="form-control" id="hw-title" placeholder="Alege un titlu">

                <div class="form-group">
                <label for="sel1">Curs:</label>
                <select class="form-control" id="hw-curssel">
                  <option>IP fara Patrut :(</option>
                  <option>Curs 2</option>
                  <option>Curs 3</option>
                  <option>Curs 4</option>
                </select>
                </div>

                Homework files (can attach more than one):
                <br />
                <input type="file" name="homework[]" multiple />
                <br /><br />
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
      </div>
    </div>
  </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

@endsection