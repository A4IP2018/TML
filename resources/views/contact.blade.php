@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <br>
        <p class="text-center" style="font-size: 30px">Ai nel&#259;muriri? &#206;ntreab&#259;-ne!</p>
        <div class="card card-register mx-auto mt-5">
        <div class="card">
            <div class="card-body">
        <!--<form action="/action_page.php">-->
        <form method="POST" action="{{ url('/contact') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="prenumeInput">Prenume:</label>
                <input name="first_name" class="form-control" placeholder="Introdu numele t&#259;u" id="prenumeInput">
            </div>
            <div class="form-group">
                <label for="numeInput">Nume:</label>
                <input name="last_name" class="form-control" placeholder="Introdu prenumele t&#259;u" id="numeInput">
            </div>
            <div class="form-group">
                <label for="emailInput">Email:</label>
                <input name="email" class="form-control" placeholder="Introdu adresa de mail" id="emailInput" required>
            </div>
            <div class="form-group">
                <label for="pwd">Mesaj:</label>
                <textarea id="form_message" name="message" class="form-control" placeholder="Mesajul dorit" rows="4" required="required" data-error="Please,leave us a message."></textarea>
            </div>
            <button type="send-message" class="btn btn-primary">Trimite</button>
        </form>
            </div>
        </div>
        </div>
    </div>
</div>



@endsection