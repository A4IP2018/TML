@extends('layouts.master')


@section('content')

<?php
    $homeworks = get_teacher_homeworks();
?>
<div class="row">
    <div class="col-12">

        <blockquote class="blockquote text-center">
            <p class="mb-0">Comparator</p>
            <footer class="blockquote-footer">Toti sau 2</footer>
        </blockquote>

        @if (!is_null($homeworks) and $homeworks->count() > 0)
            <div class="form-group">
                <form action="{{ url('/compare') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="sel1">Tema:</label>
                    <div class="input-group">
                        <select name="compare-homework" class="form-control" id="hw-curssel">
                            @foreach ($homeworks as $homework)
                                <option value="{{ $homework->id }}">{{ $homework->course->course_title . ', ' . $homework->name }}</option>
                            @endforeach
                        </select>
                        <button type="sumbit" class="btn btn-primary ml-3">Caut&#259;</button>
                    </div>
                </form>
            </div>

            @if (isset($current_homework))
                <div class="card-columns">
                    <div class="card">
                        <div class="card-header">Num&#259;rul rezolv&#259;rilor &#238;nc&#259;rcate </div>
                        <div class="card-body">{{ $homework->files->groupBy('batch_id')->count() ? $homework->files->groupBy('batch_id')->count() : 0 }}</div>
                    </div>

                    <div class="card">
                        <div class="card-header">Num&#259;rul de parechi suspecte  </div>
                        <div class="card-body">{{ $all_comparisons->count() ? $all_comparisons->count() : 0 }}</div>
                    </div>

                    <div class="card">
                        <div class="card-header">Procentul maxim de similaritate </div>
                        <div class="card-body">{{ ($all_comparisons->max('simm')) ? $all_comparisons->max('simm') : 0 }}</div>
                    </div>

                    <div class="card">
                        <div class="card-header">Num&#259;rul de utilizatori implica&#539;i </div>
                        <div class="card-body">{{ $unique_users->count() ? $unique_users->count() : 0 }}</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Perechi suspecte</div>
                    <div class="card-body">
                        <ul class="list-group">
                        @foreach ($all_comparisons as $comparison)
                            <li class="list-group-item">
                                <a href="{{ url('/user/' . $comparison['user_1']->id) }}"> {{ get_name_by_id($comparison['user_1']->id) }}</a> <->
                                <a href="{{ url('/user/' . $comparison['user_2']->id) }}"> {{ get_name_by_id($comparison['user_2']->id) }}</a>&nbsp
                                <span class="badge badge-secondary badge-pill">{{ $comparison['simm'] }}% similaritate - vezi temele</span>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>


            <!--
                <div class="card-group">

                    <form action="{{ url('compare-action') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="card border-success mb-3" style="width: auto">
                                    <div class="card-header bg-transparent border-success">
                                        <div class="form-group">

                                            <label for="sel1">Student #1</label>

                                            <select name="first-compare-field" class="form-control"
                                                    id="hw-curssel">

                                            </select>

                                        </div>
                                    </div>

                                    <div class="card-body text-success">

                                        <h5 class="card-title">Laborator 8</h5>
                                        <p class="card-text">
                                            "Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                            ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card border-success mb-3" style="width: auto">
                                    <div class="card-header bg-transparent border-success">
                                        <div class="form-group">

                                            <label for="sel1">Student #2</label>

                                            <select name="second-compare-field" class="form-control"
                                                    id="hw-curssel">

                                            </select>

                                        </div>
                                    </div>

                                    <div class="card-body text-success">

                                        <h5 class="card-title">Laborator 8</h5>

                                        <p class="card-text">
                                            "Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                            ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                            qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Compara teme</button>
                    </form>
                </div>

                <div class="card border-success mb-3" style="width: auto">
                    <div class="card-header bg-transparent border">
                        <div class="card-body text">

                            <h5 class="card-title">Rezultat:</h5>


                            <p class="card-text">Asemanare tema {{ session('procent') }}%</p>

                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width:{{ session('procent') }}%"></div>
                            </div>

                        </div>
                    </div>
                </div>
                -->
            @endif
        @else
            <h4 class="text-center">Nu ai creat nicio tem&#259; :(</h4>
        @endif
    </div>
</div>

@endsection