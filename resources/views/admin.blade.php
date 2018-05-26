@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col col-6">
    <div class="card">
      <div class="card-header text-white bg-primary">Coduri secrete pentru profesor</div>
      <div class="card-body">
        <ul class="list-group">
          @foreach ($teacher_codes as $teacher_code)
          <li class="list-group-item">{{ $teacher_code->code }}</li>
          @endforeach
        </ul>
      </div>
      <div class="card-footer">Se ofer&#259; unui utilizator pentru a ob&#539;ine privilegii de profesor la &#238;nregistrare</div>
    </div>
  </div>

  <div class="col col-6">
    <div class="card">
      <div class="card-header text-white bg-primary">Coduri secrete pentru administrator</div>
      <div class="card-body">
        <ul class="list-group">
          @foreach ($admin_codes as $admin_code)
            <li class="list-group-item">{{ $admin_code->code }}</li>
          @endforeach
        </ul>
      </div>
      <div class="card-footer">Se ofer&#259; unui utilizator pentru a ob&#539;ine privilegii de administrator la &#238;nregistrare</div>
    </div>
  </div>
</div>


@endsection
