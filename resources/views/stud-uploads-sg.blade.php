@extends('layouts.master')

@section('content')

<!--single HOMEWORK UPLOAD PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Teme</a>
      </li>
    </ol>


    <div class="row">
      <div class="col-12">

        <h1>Blank</h1>
        <h1>Nota: {{ $grade->grade }}</h1>
        <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>

        <form action="{{ URL::to('grade-action') }}" method="POST">
          <input type="hidden" name="homework-id" value="{{ $homework->id }}">
          <input type="hidden" name="user-id" value="{{ $user->id }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <input type="text" name="grade">
          <button type="submit">Submit</button>
        </form>

      </div>
    </div>
  </div>
</div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->


  
@endsection