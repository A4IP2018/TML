@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col col-md-6 col-12">
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
  <br>
  <div class="col col-md-6 col-12">
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
  <br>
</div>


<h3 class="text-center mt-5">Contact</h3>
@foreach ($contacts as $contact)
<div class="card">
  <div class="card-header">
    {{ $contact->first_name . ' ' . $contact->last_name }}

      <a href="mailto:{{ $contact->email }}">
        <span class="badge badge-secondary badge-pill">{{ $contact->email }}</span>
      </a>

  </div>
  <div class="card-body">
    {{ $contact->message }}
  </div>
  <div class="card-footer">
    {{ $contact->created_at }}
  </div>
</div>
@endforeach

@endsection
