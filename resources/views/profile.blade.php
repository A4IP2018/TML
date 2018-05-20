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
    <div class="col-12">

        <div class="mb-0 mt-0">
            <i class="fa fa-archive"></i> Setari cont</div>
        <hr class="mt-0">
        <div class="card card-register mx-auto mt-4">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="name">Nume:</label>
                            @if($user->role_id==\App\Role::$TEACHER_RANK)
                            <input type="name" class="form-control" id="name" value="{{$userInfo->name}}" readonly>
                            @endif
                            @if($user->role_id==\App\Role::$ADMINISTRATOR_RANK)
                                <input type="name" class="form-control" id="name" value="{{$userInfo->first_name.' '.$userInfo->last_name}}" readonly>
                            @endif
                        </div>

                        @if($user->role_id==\App\Role::$ADMINISTRATOR_RANK)
                        <div class="form-group">
                            <label for="email">An:</label>
                            <input type="email" class="form-control" id="an" value="{{$userInfo->year}}" readonly>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Nr. matricol:</label>
                            <input type="email" class="form-control" id="nr_matr" value="{{$user->nr_matricol}}" readonly>
                        </div>

                        <label for="email">Adresa de mail:</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly>
                            <span class="input-group-append">
                                <button data-toggle="collapse" data-target="#changeEmail" class="btn btn-primary">Schimba <i class="fa fa-eraser"></i></button>
                            </span>
                        </div>

                        <div id="changeEmail" class="collapse">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ URL::to('reset-email-action') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="name">Adresa de mail veche:</label>
                                            <input name="old-email" type="name" class="form-control" id="oldMail" placeholder="Scrie vechea ta adresa de mail">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Adresa de mail noua:</label>
                                            <input name="new-email" type="name" class="form-control" id="newMail" placeholder="Scrie noua ta adresa de mail">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salveaza</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <label for="password">Parola:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pass" value="*******" readonly>
                            <span class="input-group-append">
                                <button data-toggle="collapse" data-target="#changePassword" class="btn btn-primary">Schimba <i class="fa fa-eraser"></i></button>
                            </span>
                        </div>

                        <div id="changePassword" class="collapse">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ URL::to('reset-password-action') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <label for="name">Parola veche:</label>
                                            <input name="old-password" type="password"  class="form-control" id="oldPass" placeholder="Scrie vechea ta parola">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Parola noua:</label>
                                            <input name="new-password" type="password" class="form-control" id="newPass" placeholder="Scrie noua ta parola">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salveaza</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

</div>
</div>
  </div>
</div>
  
@endsection