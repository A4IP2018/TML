@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="mb-0 mt-0">
            <i class="fa fa-archive"></i> Setari cont</div>
        <hr class="mt-0">
        <div class="card card-register mx-auto mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nume:</label>
                        @if($user->role->rank == \App\Role::$TEACHER_RANK)
                            <input type="name" class="form-control" id="name" value="{{ $userInfo->name }}" readonly>
                        @else
                            <input type="name" class="form-control" id="name" value="{{ $userInfo->first_name.' '.$userInfo->last_name }}" readonly>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="role">Rol:</label>
                        <input type="role" class="form-control" id="name" value="{{ get_role() }}" readonly>
                    </div>

                    @if (Auth::check() and (is_teacher() or Auth::id() == $user->id))
                        @if ($user->role->rank == \App\Role::$MEMBER_RANK)
                            <label for="nr_matricol">Nr. matricol:</label>
                            @if (Auth::check() and Auth::id() == $user->id)
                            <form action="{{ url('/change-nr-matricol') }}" METHOD="POST">
                                <div class="input-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input name="nr-matricol" type="text" class="form-control" id="nr_matr" value="{{ $user->student_information->nr_matricol }}" >
                                    <span class="input-group-append">
                                        <button data-toggle="collapse" class="btn btn-primary">Schimba <i class="fa fa-eraser"></i></button>
                                    </span>
                                </div>
                            </form>
                            @else
                                <input name="nr-matricol" type="text" class="form-control" id="nr_matr" value="{{ $user->student_information->nr_matricol }}" readonly>
                            @endif
                            <br>
                        @endif
                    @endif

                    @if (Auth::check() and (is_teacher() or Auth::id() == $user->id))
                    <label for="email">Adresa de mail:</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" value="{{$user->email}}" readonly>
                        @if (Auth::check() and Auth::id() == $user->id)
                        <span class="input-group-append">
                            <button data-toggle="collapse" data-target="#changeEmail" class="btn btn-primary">Schimba <i class="fa fa-eraser"></i></button>
                        </span>
                        @endif
                    </div>
                    @endif

                    @if (Auth::check() and Auth::id() == $user->id)
                    <div id="changeEmail" class="collapse">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ url('/change-email') }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="old-email">Adresa de mail veche:</label>
                                        <input name="old-email" type="name" class="form-control" id="oldMail" placeholder="Scrie vechea ta adresa de mail">
                                    </div>
                                    <div class="form-group">
                                        <label for="new-email">Adresa de mail noua:</label>
                                        <input name="new-email" type="name" class="form-control" id="newMail" placeholder="Scrie noua ta adresa de mail">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salveaza</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endif

                    @if (Auth::check() and Auth::id() == $user->id)
                    <label for="password">Parola:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="pass" value="*******" readonly>
                        <span class="input-group-append">
                            <button data-toggle="collapse" data-target="#changePassword" class="btn btn-primary">Schimba <i class="fa fa-eraser"></i></button>
                        </span>
                    </div>
                    <br>

                    <div id="changePassword" class="collapse">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('/change-password') }}" method="POST">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
  
@endsection