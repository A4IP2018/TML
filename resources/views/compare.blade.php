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
        

        <div class="card-group">
            <div class="card">
                <div class="card border-success mb-3" style="max-width: 40rem;">
                <div class="card-header bg-transparent border-success">
                <div class="form-group">

                    <label for="sel1">Student #1</label>

                    <!--Select student id 1-->
                    <select name="hw-compare-stud1" class="form-control" id="hw-curssel">

                    <option>Upload#1</option>
                    <option>Upload#2</option>
                    <option>Alt stud</option>

                    </select>

                    </div>
                </div>
                <div class="card-body text-success">

                <!--Homework stud 1 title-->
                <h5 class="card-title">Laborator 8</h5>

                <!--Homework stud 1 content-->
                <p class="card-text">Tema primului student.</p>

                </div>
                </div>
            </div>

            <div class="card">
                <div class="card border-success mb-3" style="max-width: 40rem;">
                <div class="card-header bg-transparent border-success">
                <div class="form-group">

                    <label for="sel1">Student #2</label>

                    <!--Select student id 2-->
                    <select name="hw-compare-stud2" class="form-control" id="hw-curssel">

                    <option>Upload#1</option>
                    <option>Upload#2</option>
                    <option>Alt stud</option>

                    </select>

                    </div>
                </div>
                <div class="card-body text-success">

                <!--Homework stud 2 title-->
                <h5 class="card-title">Laborator 8</h5>

                <!--Homework stud 2 content-->
                <p class="card-text">Tema celui de-al doilea student.</p>

                </div>
                </div>
            </div>

        </div>

        <div class="card border-success mb-3" style="max-width: 70rem;">
                <div class="card-header bg-transparent border">
                <div class="card-body text">

                    <!--compare result-->
                    <h5 class="card-title">Rezultat:</h5>
                    <p class="card-text">Asemanare tema 50%</p>

                    <!--result bar depending on compare result-->
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width:50%"></div>
                    </div>

                </div>
                </div>
        </div>

        <!--Select All to compare all homework-->
        <br><a href="#" class="btn btn-primary btn-lg btn-block">Compara toate temele</a>

        <!--Select Two to compare only the two of them-->
        <br><a href="#" class="btn btn-primary btn-lg btn-block">Compare cele 2 teme</a><br>


        </div>
    </div>
    </div>
    </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection