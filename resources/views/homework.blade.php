@extends('layouts.master')


@section('content')

    <!--MULTIPLE HOMEWORK PAGE-->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Bord</a>
                </li>
                <li class="breadcrumb-item active">Teme {{ (is_teacher(Auth::id())) ? "publicate" : "la care te-ai abonat" }}</li>
            </ol>

            <div class="errors">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="input-group">
            <!--search for homework-->
            <input name="homework-search" class="form-control" type="text" placeholder="Cauta tema...">
            <span class="input-group-append">
                          <button data-toggle="collapse" data-target="#demo" class="btn btn-secondary">Filtru <i class="fa fa-filter"></i></button>

                          <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                          </button>
                      </span>
          </div>
          <div id="demo" class="collapse">
            <div class="card">
                <div class="card-body">            
                    <form>
                        <h6>Teme:&nbsp; </h6>
                        <label class="checkbox-inline">
                            <input type="checkbox" value=""> Noi
                        </label> &ensp;
                        <label class="checkbox-inline">
                            <input type="checkbox" value=""> Necorectate
                        </label> &ensp;
                        <label class="checkbox-inline">
                            <input type="checkbox" value=""> Corectate
                        </label>
                    </form>
<hr>
                    <form>
                        <h6>Cursuri:&nbsp; </h6>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="">  Abonament
                        </label> &ensp;
                        <label class="checkbox-inline">
                            <input type="checkbox" value="">  Toate
                        </label> &ensp;
                    </form>
            </div>
        </div>
  </div>
          
<br>
                    @if (is_teacher(Auth::id()))
                        <!--press to create new homework <TEACHER>-->
                        <a href="{{ url('/homework/create') }}" class="btn btn-primary btn-lg btn-block">Tema noua</a>
                        <!--press to compare homework <TEACHER>-->
                        <a href="{{ url('/compare') }}" class="btn btn-secondary btn-lg btn-block">Compara</a>
                        <hr class="mt-2">
                    @endif

                    @if ($homeworks->count() > 0)
                    <div class="card-columns">
                        @foreach ($homeworks as $homework)
                            <!-- Example Homework Card-->
                            <div class="card mb-3">
                                <div class="card-header bg-transparent">
                                    @if ($homework->course)
                                    <a href="{{ url('/course/' . $homework->course->slug) }}">{{ $homework->course->course_title }}</a>
                                    @endif
                                </div>
                                <div class="card-body text">
                                    <!--Homework title-->
                                    <h5 class="card-title">{{ $homework->name }}</h5>
                                    <!--Homework description-->
                                    <p class="card-text">{{ $homework->description }}</p>
                                </div>

                                <!--Homework deadline-->

                                <div class="card-footer bg-transparent">Termen
                                    limita: {{ $homework->deadline }}</div>
                                <div class="card-footer bg-transparent">
                                    <!--go to homework page-->
                                    <a href="{{ url('/homework/' . $homework->slug) }}"
                                       class="btn btn-info">Detalii</a>
                                    <!--Homework edit <TEACHER>-->
                                    @if (Auth::check() and is_homework_author($homework))
                                    <a href="{{ url('/homework/' . $homework->slug . '/edit') }}"
                                       class="btn btn-secondary">Editeaza</a>
                                    @endif
                                    <button type="button" class="btn btn-primary">
                                        Necorectate <span class="badge badge-light">9</span>
                                        <span class="sr-only">unread messages</span>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        Corectate <span class="badge badge-light">9</span>
                                        <span class="sr-only">unread messages</span>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        Noi <span class="badge badge-light">9</span>
                                        <span class="sr-only">unread messages</span>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    @else
                        <h4 class="text-center" >Nicio tema aici, incearca sa te abonezi la cateva <a href="{{ url('/course') }}">cursuri</a></h4>
                    @endif


                    <!--pagination
                    
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Inapoi</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">Inainte</a></li>
                    </ul>
                    --->
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@endsection