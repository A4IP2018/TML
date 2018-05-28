@extends('layouts.master')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-bell"></i> Notificarile mele</div>
            <div class="card-body">
                @if ($notifications->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach ($notifications as $notification)
                    <li class="list-group-item">
                        <div class="text-muted">{{ $notification->created_at }}</div>
                        <span>
                            {!! $notification->message !!}
                        </span>
                    </li>
                    @endforeach
                </ul>
                @else
                    Nicio notificare :(
                @endif
            </div>
            <div class="card-footer">
                <form action="{{ url('/notifications/remove') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary">&#x218;terge toate notificarile</button>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection