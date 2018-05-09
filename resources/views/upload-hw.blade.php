@extends('layouts.master')


@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <form action="/upload" method="post" enctype="multipart/form-data">
                Homework title:
                <br />
                <input type="text" name="name" />
                <br /><br />
                Homework files (can attach more than one):
                <br />
                <input type="file" name="homework[]" multiple />
                <br /><br />
                <input type="submit" value="Upload" />
            </form>            
        </div>
      </div>
    </div>
  </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

@endsection