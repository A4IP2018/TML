@extends('layouts.master')


@section('content')

    <!--COMPARE PAGE-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <blockquote class="blockquote text-center">
                        <p class="mb-0">Comparator</p>
                        <footer class="blockquote-footer">Toti sau 2</footer>
                    </blockquote>

                    <div class="form-group">

                        <label for="sel1">Tema:</label>

                        <!--Select homework from teacher homework to compare-->
                        <select name="hw-to-compare-sel" class="form-control" id="hw-curssel">

                            <option>Laborator 8</option>
                            <option>Alta tema</option>

                        </select>

                    </div>


                    <div class="card-group" style="width: 100%">

                        <form action="{{ url('compare-action') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card border-success mb-3" style="width: auto">
                                        <div class="card-header bg-transparent border-success">
                                            <div class="form-group">

                                                <label for="sel1">Student #1</label>

                                                <!--Select student id 2-->
                                                <select name="first-compare-field" class="form-control"
                                                        id="hw-curssel">
                                                    @foreach ($files as $file)
                                                        <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="card-body text-success">

                                            <!--Homework stud 2 title-->
                                            <h5 class="card-title">Laborator 8</h5>

                                            <!--Homework stud 2 content-->
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

                                                <!--Select student id 2-->
                                                <select name="second-compare-field" class="form-control"
                                                        id="hw-curssel">
                                                    @foreach ($files as $file)
                                                        <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="card-body text-success">

                                            <!--Homework stud 2 title-->
                                            <h5 class="card-title">Laborator 8</h5>

                                            <!--Homework stud 2 content-->
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

                                <!--compare result-->
                                <h5 class="card-title">Rezultat:</h5>


                                <p class="card-text">Asemanare tema {{ session('procent') }}%</p>

                                <!--result bar depending on compare result-->
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:{{ session('procent') }}%"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--Select All to compare all homework-->


                    <!--Select Two to compare only the two of them-->
                    {{--<br><a href="#" class="btn btn-primary btn-lg btn-block">Compare cele 2 teme</a><br>--}}


                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@endsection