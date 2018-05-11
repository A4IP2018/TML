@extends('layouts.master')


@section('content')

<!--MESSAGES WITH A CERTAIN PERSON PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Bord</a>
      </li>
      <li class="breadcrumb-item active">Mesaje</li>
    </ol>

    <!--messenger style-->
    <div class="row">
      <div class="col-12">
        

        <div class="input-group">

        <!--search for something in conversations-->
        <input name="homework-search" class="form-control" type="text" placeholder="Cauta in conversatii...">

        <span class="input-group-append">
        <button class="btn btn-primary" type="button">
        <i class="fa fa-search"></i>
        </button>

        </span>
        </div>
        <br>


        <!--CONVERSATION WITH SOMEONE BODY-->
        <div class="card border-primary mb-3" style="max-width:20rem;">
          <div class="card-body">

          <!--SOMEONE'S NAME-->
          <h5 class="card-title">Batman</h5>

          <!--someone's last message to you-->
          <p class="card-text">[7:00] Bunaaaaaaaaaa.</p>
         
          </div>
        </div>


        <br>
        <!--CONVERSATION WITH SOMEONE BODY-->
        <div class="card border-primary mb-3" style="max-width:20rem;">
          <div class="card-body">

          <!--YOU-->
          <h5 class="card-title">Eu</h5>

          <!--YOUR RESPONSE-->
          <p class="card-text">[7:01] HEEEEEEEEEEEEEY.</p>
         
          </div>
        </div>

        
        <br>
        <!--CONVERSATION WITH SOMEONE BODY-->
        <div class="card border-primary mb-3" style="max-width:20rem;">
          <div class="card-body">

          <!--SOMEONE'S NAME-->
          <h5 class="card-title">Batman</h5>

          <!--someone's last message to you-->
          <p class="card-text">[7:30] I am batmoooooooooooooooon.</p>
          
          </div>
        </div>




        </br>
        <div class="form-group">
          <!--WRITE NEW MESSAGE-->
          <textarea name="new-message" class="form-control" rows="5" id="hw-descr"></textarea>
        
        </div>

        <button type="submit" class="btn btn-primary">Trimite</button>

      </div>
    </div>
  </div>
  <!-- /.container-fluid-->
</div>
<!-- /.content-wrapper-->

@endsection