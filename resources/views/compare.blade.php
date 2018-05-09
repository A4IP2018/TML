@extends('layouts.master')


@section('content')

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
          <select class="form-control" id="hw-curssel">
            <option>Laborator 8</option>
            <option>Other</option>
          </select>
        </div>
        

        <div class="card-group">
            <div class="card">
                <div class="card border-success mb-3" style="max-width: 40rem;">
                <div class="card-header bg-transparent border-success">
                <div class="form-group">
                    <label for="sel1">Student #1</label>
                    <select class="form-control" id="hw-curssel">
                    <option>Upload#1</option>
                    <option>Upload#2</option>
                    <option>Other</option>
                    </select>
                    </div>
                </div>
                <div class="card-body text-success">
                <h5 class="card-title">Laborator 8</h5>
                <p class="card-text">Tema primului student.</p>
                </div>
                <div class="card-footer bg-transparent border-success">Footer</div>
                </div>
            </div>

            <div class="card">
                <div class="card border-success mb-3" style="max-width: 40rem;">
                <div class="card-header bg-transparent border-success">
                <div class="form-group">
                    <label for="sel1">Student #2</label>
                    <select class="form-control" id="hw-curssel">
                    <option>Upload#1</option>
                    <option>Upload#2</option>
                    <option>Other</option>
                    </select>
                    </div>
                </div>
                <div class="card-body text-success">
                <h5 class="card-title">Laborator 8</h5>
                <p class="card-text">Tema celui de-al doilea student.</p>
                </div>
                <div class="card-footer bg-transparent border-success">Footer</div>
                </div>
            </div>

        </div>

        <div class="card border-success mb-3" style="max-width: 70rem;">
                <div class="card-header bg-transparent border">
                <div class="card-body text">
                    <h5 class="card-title">Rezultat:</h5>
                    <p class="card-text">Asemanare tema 50%</p>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width:50%"></div>
                    </div>
                </div>
                </div>
        </div>

        <br><a href="#" class="btn btn-primary btn-lg btn-block">Compare All</a>
        <br><a href="#" class="btn btn-primary btn-lg btn-block">Compare Two</a><br>


        </div>
    </div>
    </div>
    </div>
</div>

<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection