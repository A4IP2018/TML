@extends('layouts.master')

@section('content')

    <!--NOTIFICATIONS PAGE-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Notificari</a>
                </li>
            </ol>
      <div class="row">
        <div class="mb-2" style="width:100%"></div>
        <div class="col-sm-12">
          <div class="card-header">
            <i class="fa fa-bell"></i>Notificările mele</div>
          <div class="list-group list-group-flush-small " style="height:630px; overflow-y:scroll">
                <hr class="mt-2">
                    <!--notifications list-->
                <div class="media>
                        <ul class="list-group list-group-flush">
                        
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-envelope fa-fw"></i>Comentariu nou la
                                    <a href="#">Tema 5</a> (materie: <a href="#">Programare Avansata</a>)
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-arrow-up fa-fw"></i>O noua <a href="#">tema</a> a fost adaugata la materia <a href="#">Introducere in Criptografie</a>
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-arrow-circle-o-up fa-fw"></i>Un nou comentariu a fost adaugat la o <a href="#">tema</a> incarcata de tine!
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                     <i class="fa fa-calendar-times-o fa-fw"></i>Mai sunt 3 zile pana la termenul limita de postare a <a href="#">temei</a>! (materie: <a href="#">PSGBD</a>)
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-check-square fa-fw"></i>Ai primit o nota la <a href="#">Tema 7</a>! (materie: <a href="#">PSGBD</a>)
                                </span>
                            <hr>
                            </li>
                            
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-envelope fa-fw"></i>Comentariu nou la
                                    <a href="#">Tema 5</a> (materie: <a href="#">Programare Avansata</a>)
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-arrow-up fa-fw"></i>O noua <a href="#">tema</a> a fost adaugata la materia <a href="#">Introducere in Criptografie</a>
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-arrow-circle-o-up fa-fw"></i>Un nou comentariu a fost adaugat la o <a href="#">tema</a> incarcata de tine!
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                     <i class="fa fa-calendar-times-o fa-fw"></i>Mai sunt 3 zile pana la termenul limita de postare a <a href="#">temei</a>! (materie: <a href="#">PSGBD</a>)
                                </span>
                            <hr>
                            </li>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-check-square fa-fw"></i>Ai primit o nota la <a href="#">Tema 7</a>! (materie: <a href="#">PSGBD</a>)
                                </span>
                            <hr>
                            <li class="list-group-item>
                                <span class="text-success">
                                    <i class="fa fa-dot-circle-o fa-fw"></i>...<a href="#">mai multe</a>
                                </span>
                            <hr>
                            </li>
                        </ul>
                        </div>
                </div>
        <div class="card-footer small text-muted">Ultima notificare 11:59 PM</div>
        </div>
      </div> <!--/.row-->
    </div>
  </div>


    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->




@endsection