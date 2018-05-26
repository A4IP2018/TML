@extends('layouts.master')


@section('content')


<div class="row">
    <div class="col-12">
        <form action="{{ url('homework/'. $homework->slug) }}" method="POST">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="form-group row">
                <label for="example-date-input" class="col-1 col-form-label">Termen limita:</label>
                <div class="col-10">
                    <input name="deadline" class="form-control" type="date"
                           value="{{ \Carbon\Carbon::parse($homework->deadline)->toDateString() }}"
                           id="example-date-input">
                </div>
            </div>

            <button name="homework-edit" type="submit" class="btn btn-primary">Salveaza</button>

            <button name="homework-delete" type="submit" class="btn btn-primary">Sterge</button>

            <a href="{{ url('/homework') }}" class="btn btn-secondary">&#206;napoi</a>

        </form>

    </div>
</div>

@endsection
