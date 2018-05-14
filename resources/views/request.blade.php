@extends('layouts.master')

@section('content')

<!--REQUEST FOR A HOMEWORK PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Cerere</a>
      </li>
    </ol>


    <div class="row">
      <div class="col-12">




  <!-- Pentru -->
  <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Pentru </span>
    </div>
    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" >
  </div>
        
<!-- De la: -->
<div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">De la </span>
    </div>
    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>

  <!-- Tema -->
  <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Tema </span>
    </div>
    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>

   <!-- Titlu -->
   <div class="input-group input-group-sm mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Titlu </span>
    </div>
    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
  
  <!--Mesajul-->
  <div class="input-group input-group-lg">
      <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
  </div>
  <br> 
      
  <!--Buton trimitere-->
  <button class="btn btn-primary" aria-label="Center" type="submit">Trimite</button>
      





        
      
      
      
      </div>
    </div>
  </div>

  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->


  
@endsection