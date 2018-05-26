@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-12">
    @foreach($files_grouped as $group)
      <div class="card mb-3">
        <div class="card-header">{{ $group->first()->homework->course->course_title }}</div>
        <div class="card-body">
        @foreach($group as $file)
          <?php
            $real_name = $file->file_name;
            $pos = strpos($real_name, '.');
            if ($pos != FALSE and $pos < strlen($real_name)) {
                $real_name = substr($real_name, $pos + 1);
            }
          ?>
          <span class="badge badge-secondary p-2"><a class="text-white" href="{{ url('upload/' . $file->file_name) }}">{{ $real_name }}</a></span>
        @endforeach
        </div>

        <div class="card-footer bg-transparent border">
          <a href="{{ url('/upload/' . $file->file_name ) }}" class="btn btn-info">Detalii</a>
        </div>


      </div>
    @endforeach
  </div>
</div>

@endsection