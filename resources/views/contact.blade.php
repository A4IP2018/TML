@extends('layouts.master')

@section('content')

    <!--CONTACT PAGE-->




            <div class="row">
                <div class="col-12">
                    <br>
                    <p class="text-center" style="font-size: 23px">Ai nelămuriri? Intreabă-ne!</p>
                    <div class="card card-register mx-auto mt-3">
                    <div class="card">
                        <div class="card-body">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="name">Nume:</label>
                            <input type="name" class="form-control" placeholder="Introduceți numele" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Adresa de e-mail:</label>
                            <input type="email" class="form-control" placeholder="Introduceți adresa de e-mail" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mesajul:</label>
                            <textarea id="form_message" name="message" class="form-control" placeholder="Introduceți mesajul" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                        </div>
                        <button type="send-message" class="btn btn-primary">Trimite mesajul</button>
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



@endsection