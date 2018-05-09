@extends('layouts.master')


@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Homework-sg</li>
  </ol>
    <div class="row">
      <div class="col-12">
        <div class="progress">
            <!--deadline bar-->
            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            1 week left</div>
        </div>
        <!--homework AUTHOR-->
        <div class="card text-center">
        <div class="card-header">PSGBD</div>
        <div class="card-body">
            <h5 class="card-title">Laboratorul 8</h5>
            <p class="card-text">1.) Creati o procedura stocata care sa exporte tabelele studenti si prieteni pentru utilizatorul curent intr-un format la alegere (mai putin SQL - adica fara sa generati inserturi care ar popula automat tabelele).</p>
            <hr><p class="card-text">Format: .zip</p>
            <hr><p class="card-text">Deadline: 25 Mai 2018</p>
            <hr><p class="card-text">Autor: Cosmin Varlan</p>
            <hr>
            <a href="{{ url('/upload-hw') }}" class="btn btn-primary">Upload</a>
            <a href="{{ url('/reviews') }}" class="btn btn-primary">Reviews</a>
            <a href="#" class="btn btn-primary">Follow</a>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
        </div>


        </div>
    </div>
    </div>
    </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection