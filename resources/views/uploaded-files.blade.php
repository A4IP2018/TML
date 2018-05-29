@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-12">
    @if (isset($homeworks_title))
      <h3>{{ $homeworks_title }}</h3>
      <hr>
    @endif
    @foreach($files_grouped as $group)
      <div class="card mb-3">
        <div class="card-header">
          <a href="{{ url('/user/'. $group->first()->user->id ) }}">{{ get_name_by_id($group->first()->user->id) }}</a>
            @if ($group->first()->grade)
                <span class="badge badge-{{ ($group->first()->grade->grade > 4) ? 'success' : 'danger' }} badge-pill">Nota {{ $group->first()->grade->grade }}</span>
            @endif
        </div>
        <div class="card-body">
        @foreach($group as $file)
          <span class="badge badge-secondary p-2"><a class="text-white" href="{{ url('/download/' . basename($file->storage_path) ) }}">{{ $file->requirement->description }}</a></span>
        @endforeach
        </div>

        <div class="card-footer bg-transparent border">
          <a href="{{ url('/upload/' . $file->batch_id) }}" class="btn btn-info">Detalii</a>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection