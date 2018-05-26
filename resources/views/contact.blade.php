@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-12">
        <br>
        <p class="text-center" style="font-size: 30px">Ai nelamuriri? Intreaba-ne!</p>
        <div class="card card-register mx-auto mt-5">
        <div class="card">
            <div class="card-body">
        <form action="/action_page.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="name" class="form-control" placeholder="Enter your name here" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" placeholder="Enter your e-mail address here" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Message:</label>
                <textarea id="form_message" name="message" class="form-control" placeholder="Enter your message here" rows="4" required="required" data-error="Please,leave us a message."></textarea>
            </div>
            <button type="send-message" class="btn btn-primary">Send message</button>
        </form>
            </div>
        </div>
        </div>
    </div>
</div>



@endsection