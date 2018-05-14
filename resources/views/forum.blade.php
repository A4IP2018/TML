@extends('layouts.master')

@section('content')

<!--FORUM PAGE-->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Forum</a>
      </li>
    </ol>
      <div class="row">
          <div class="col-12">
              <div class="input-group">
              <!--discussion search-->
                  <input name="discussion-search" class="form-control" type="text" placeholder="Cauta discutie...">
                  <span class="input-group-append">
                      <button class="btn btn-primary" type="button">
                          <i class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
              <br><a href="#" class="btn btn-primary smaller">Adauga discutie</a><br>
              <br>
                  <div class="form-control list-group-item list-group-item-action text-muted smaller">
                      <a href="#"><strong>Disciplina discutiei</strong></a>
                      <div>
                          <!--Discussion title-->
                          <a href="#"><strong>Titlul discutiei</strong></a>
                          <!--Discussion description-->
                          <p>She walked over to the window and reflected on her fancy surroundings. She had always
                              loved quiet Paris with its real, regurgitated rivers. It was a place that
                              encouraged her tendency to feel happy.
                          </p>
                      </div>
                      <hr>
                      <table style="width:100%">
                          {{--<tr style="text-align:left">--}}
                              {{--<th>Autor</th>--}}
                              {{--<th>Data</th>--}}
                              {{--<th>Raspunsuri</th>--}}

                          {{--</tr>--}}
                          <tr>
                              <td>Autor <a href="#">utilizator</a></td>
                              <td>Data <a href="#">5 aprilie 2018</a></td>
                              <td>Raspunsuri <a href="#">25</a></td>
                          </tr>
                      </table>
                      <div style="text-align: right; ">
                          <a href="#" class="btn btn-primary smaller">Participa la discutie</a>
                      </div>
                  </div>
              <br>
          </div>
          <!-- /.container-fluid-->
          <!-- /.content-wrapper-->
      </div>
  </div>
</div>
  
@endsection