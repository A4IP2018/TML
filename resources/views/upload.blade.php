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

            <div class="mb-0 mt-4">
                <i class="fa fa-newspaper-o"></i> Incarcare tema</div>
            <hr class="mt-2">
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
                <div class="card-group" style="width: fit-content; min-width: 50rem">
                <div class="card border-primary mb-3">
                    <div class="card-header">Tema</div>
                    <div class="card-body text-primary">
                        <h5 class="card-title">{{ $homework->name }}</h5>
                    </div>
                </div>

                @if ($homework->course)
                    <div class="card border-primary mb-3">
                        <div class="card-header">Curs</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title">{{ $homework->course->course_title }}</h5>
                        </div>
                    </div>
                @endif

                @if ($homework->category)
                    <div class="card border-primary mb-3">
                        <div class="card-header">Categorie</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title">{{ $homework->category->name }}</h5>
                        </div>
                    </div>
                @endif
                </div>
                <br/>

                <p>
                Fisiere tema :
                </p>



                <div class="input-group" style="width: fit-content">
                    <div class="custom-file">
                        <input name="fileToUpload" type="file" class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile04">Incarca</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button">Upload</button>
                    </div>
                </div>

                <br>

                <!--homework uploaded files-->
                <div class="card-columns">

                    <div class="card" style="width: auto;">
                        <div class="card-header bg-transparent border">

                            <div class="card-body">

                                <!--homework file title-->
                                <h6 class="card-subtitle mb-2 text-muted">index.html</h6>
                                <!--homework file extension-->
                                <!-- <p class="card-text">.txt</p> -->

                            </div></div></div>


                    <div class="card" style="width: auto;">
                        <div class="card-header bg-transparent border">

                            <div class="card-body">

                                <!--homework file title-->
                                <h6 class="card-subtitle mb-2 text-muted">ex1.sql</h6>
                                <!--homework file extension-->
                                <!--  <p class="card-text">.sql</p> -->

                            </div></div></div>



                </div>


            </form>


        </div>
      </div>
    </div>
  </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

@endsection