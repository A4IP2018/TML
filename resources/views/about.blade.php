@extends('layouts.master')

@section('content')

    <!--ABOUT PAGE-->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->


            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/keyboard.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/laptop.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/keyboard.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <br>
                    <h4 class="text-center">Despre noi</h4>
                    <br>
                    <div class="d-flex justify-content-center">
                    <p class="col-sm-4 text-center">Suntem o echipa de studenti de la <a href="https://www.info.uaic.ro">Facultatea de Informatica</a> din Iasi ce doreste a crea o aplicatie destinata colectarii si compararii temelor de laborator. Temele pot fi comparate atat vizual, cat si automat, pe platforma. Aplicatia genereaza rapoarte pe teme primite, autorii temelor, teme grupate in functie de materie si alte informatii. De asemenea, aceasta permite exportarea temelor si a rapoartelor in formate editabile.</p>
                    </div>
                    <div class="text-center">
                        <a href="https://www.info.uaic.ro"><img src="images/fii.jpg" class="rounded-circle" width="80px" height="80px" style="margin-top: 50px"></a>
                    </div>









                </div>
            </div>
        </div>
        <br>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->



@endsection