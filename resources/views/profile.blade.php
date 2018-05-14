@extends('layouts.master')

@section('content')
<!--USER PROFILE PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Profil</a>
      </li>
    </ol>

<div class="row">
    <div class="col-sm-3">
    <div class="card bg-light border-dark mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><i class="fa fa-fw fa-user"></i>Username</h5>
    <p class="card-text">Some quick example text for the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"> <i class="fa fa-fw fa-map-marker"></i><cite>Iasi, ROMANIA</cite></li>
    <li class="list-group-item"> <i class="fa fa-fw fa-envelope"></i>email@example.com</li>
    <li class="list-group-item"><i class="fa fa-fw fa-globe"></i><a href="http://facebook">www.facebook.com</a></li>
    <li class="list-group-item"><i class="fa fa-fw fa-gift"></i>June 12, 1998</li>
  </ul>
  <div class="card-body">
    <a href="#" class="btn btn-primary">Trimite mesaj</a>
   <a href="#" class="btn btn-secondary">Adauga</a>
  </div>
</div>
</div>
    <div class="col-sm-6">  
    <div class="card  border-dark mb-3" style="max-width: 70rem;">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Bar Chart</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto">
                  <canvas id="myBarChart" width="100" height="70"></canvas>
                </div>
                <div class="col-sm-4 text-center my-auto">
                  <div class="h4 mb-0 text-primary">REZULTATE</div>
                  <div class="small text-muted"></div>
                  <hr>
                  <div class="h4 mb-0 text-warning">REZULTATE</div>
                  <div class="small text-muted"></div>
                  <hr>
                  <div class="h4 mb-0 text-success">REZULTATE</div>
                  <div class="small text-muted"></div>
                </div>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          </div>
</div>



    
<div class="mb-0 mt-4">
            <h5 class="card-title"><i class="fa fa-fw fa-newspaper-o"></i> &nbsp; Teme incarcate</h5>
          <hr class="mt-2">


<div class="card-columns">
        <!-- Example Homework Card-->
        <div class="card bg-light border-dark mb-3" style="width: 25rem">
          <div class="card-body text">
            <!--Homework title-->
            <h5 class="card-title">Tema: Laborator 8</h5>
          </div>
          <div class="card-footer bg-transparent border">

            &#10048; Descriere: blabla</div>

          <div class="card-footer bg-transparent border">

            &#10048; Categorie: SGBD</div>
             <div class="card-body">
          <a href="#" class="btn btn-primary">Detalii</a>
          <a href="#" class="btn btn-secondary">Editeaza</a>
        </div>
      </div>
      </div>
 

  


  
@endsection