@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-12">

            @if(!Auth::check())

                <h3 style="text-align: justify"> Salut! <br>  Pentru a putea sa iti oferim detalii despre cum se foloseste aplicatia, te rugam sa te <a href="{{url('/login')}}">Logezi</a>
                        intai de toate. <br>  Daca nu ai deja un cont, te rugam sa te <a href="{{url('/register')}}">Inregistrezi</a>. </h3>

            @endif

            @if(Auth::check() and is_teacher())

                    <h4 style="text-align: justify"> Salut! </h4>

                <ul>

                   <li>
                       Pentru a adauga un curs nou, navigati pe pagina <a href="{{url('/course')}}">Cursuri</a> si apasati pe butonul <strong>"Curs nou"</strong>
                   </li>
                    <li>
                        Pentru a adauga o tema noua, trebuie sa va asigurati ca aveti cel putin un curs adaugat de dumneavoastra. Dupa aceea, navigati pe pagina
                                    <a href="{{url('/homework')}}">Teme</a> si apasati pe butonul <strong>"Tema noua"</strong>
                    </li>
                    <li>
                        Pentru notarea unei teme, apasati fie pe butonul <strong>Necorectate</strong>, fie pe <strong>Corectate</strong>, de pe card-ul unei teme, apoi navigati
                                    la detaliile temei respective, iar de acolo aveti posibilitatea de a nota acea tema
                    </li>
                    <li>
                        Pentru compararea temelor, navigati pe pagina <a href="{{url('/compare')}}">Compara</a>, unde puteti selecta din cadrul carui curs fac parte temele pe care doriti sa le
                                    comparati, apoi selectati temele dorite pentru comparare
                    </li>

                </ul>

                @endif

            @if(Auth::check() and is_administrator())

                <h4 style="text-align: justify">Salut!</h4>

                <ul>
                    <li>
                        Accesati pagina de administrare pentru coduri speciale de acces si alte setari importante
                    </li>
                    <li>
                        Aveti de asemenea si posibilitatea de a crea sau edita cursuri si/sau eventuale teme
                    </li>
                </ul>
                @endif

            @if(Auth::check() and is_student())

                <h4 style="text-align: justify">Salut!</h4>
                <ul>
                    <li>
                        Intai de toate, va rugam sa va abonati la cursurile la care participati pentru a putea vedea si rezolva temele urcate de profesori
                    </li>
                    <li>
                        Dupa aceea, puteti rezolva temele navigand pe pagina <a href="{{url('/homework')}}">Teme</a>, apoi navigand pe detaliile fiecarei teme, de unde
                                pot fi incarcate fisierele necesare pentru rezolvarea exercitiilor. <strong>Atentie!</strong> Aveti grija la extensiile fisierelor!
                    </li>
                    <li>
                        Puteti vizualiza ulterior temele incarcate, navigand pe pagina <a href="{{url('/upload')}}">Teme incarcate</a>, unde puteti vedea notele obtinute
                    </li>
                </ul>

                @endif


        </div>
    </div>



@endsection