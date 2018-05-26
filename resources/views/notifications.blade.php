@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="mb-0 mt-0">
            <i class="fa fa-bell"></i> Notificarile mele</div>
        <hr class="mt-2">
        <!--notifications list-->
        <div class="card" style="width: auto;">
            <ul class="list-group list-group-flush">
                <br>
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
                        <i class="fa fa-dot-circle-o fa-fw"></i>...<a href="#">mai multe</a>
                    </span>
                <hr>
                </li>
            </ul>
        </div>


    </div>
</div>



@endsection