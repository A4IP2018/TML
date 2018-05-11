@extends('layouts.master')

@section('content')

<!--MULTIPLE HOMEWORK UPLOADS PAGE-->

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


        <!-- Example Homework Card-->
          <div class="card mb-3">

            <div class="card-header bg-transparent border"><a href="{{ url('/profile') }}">Student<a></div>
            
            <div class="card-body text">
              
              <!--Homework title-->
              <h5 class="card-title">Tema</h5>

              <!--Homework description-->
              <p class="card-text">Descriere Tema</p>

            </div>
            
            <div class="card-footer bg-transparent border">

            <!--go to homework page-->
            <a href="{{ url('/stud-uploads-sg') }}" class="btn btn-info">Detalii</a>

            <!--Homework edit-->
            <a href="#" class="btn btn-secondary">Editeaza</a>

            


          </div>
        </div>
      </div>
      





        
      
      
      
      </div>
    </div>
  </div>

  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->


  
@endsection