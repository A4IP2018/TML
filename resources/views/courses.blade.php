@extends('layouts.master')


@section('content')

    <!--MULTIPLE COURSES PAGE-->

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Bord</a>
                </li>
                <li class="breadcrumb-item active">Cursuri</li>
            </ol>
            <div class="row">
                <div class="col-12">

                    <div class="input-group">

                        <!--Course search-->
                        <input name="course-search" class="form-control" type="text" placeholder="Cauta curs...">
                        <span class="input-group-append">
                          <button data-toggle="collapse" data-target="#demo" class="btn btn-secondary">Filtru <i
                                      class="fa fa-filter"></i></button>

                          <button class="filter-search-button btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                          </button>
                      </span>
                    </div>
                    <div id="demo" class="collapse">
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <h6>An:&nbsp; </h6>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="year-filter form-check-input" value="1" name="year-filter"> 1
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="year-filter form-check-input" value="2" name="year-filter"> 2
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="year-filter form-check-input" value="3" name="year-filter"> 3
                                        </label>
                                    </div>
                                </form>
                                <hr>
                                <form>
                                    <h6>Semestru:&nbsp; </h6>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="semester-filter form-check-input" value="1" name="optradio"> 1
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="semester-filter form-check-input" value="2" name="optradio"> 2
                                        </label>
                                    </div>
                                </form>
                                <hr>
                                <form>
                                    <h6>Abonament:&nbsp; </h6>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="subscription-filter form-check-input" value="1" name="optradio"> Da
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="subscription-filter form-check-input" value="0" name="optradio"> Nu
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" checked class="subscription-filter form-check-input" value="2" name="optradio"> Toate
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @if (Auth::check() and is_teacher(Auth::id()))
                    <!--Press to create new Course-->
                        <br><a href="{{ url('/course/create') }}" class="btn btn-primary btn-lg btn-block">Curs nou</a>
                @endif
                <!--Multiple Courses-->
                    <div class="mb-0 mt-4">

                        <div class="card-columns">
                        @foreach ($courses as $course)
                            <!-- Example Course Card-->
                                <form action="{{ url("/course/" . $course->slug . "/subscribe") }}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="card mb-3">
                                        <div class="card-body text">
                                            <!--Course title-->
                                            <h5 class="card-title">{{ $course->course_title }}</h5>
                                            <!--Course year-->
                                            <p class="card-text">An: {{ $course->year }}</p>
                                            <!--Course semester-->
                                            <p class="card-text">Semestru: {{ $course->semester }}</p>

                                            <p class="card-text">Description: {{ $course->description }}</p>
                                        </div>
                                        <div class="card-footer bg-transparent border">

                                            <!--press to be sent to the course page-->
                                            <a href="{{ url('/course/' . $course->slug) }}">
                                                <button type="button" class="btn btn-info">Detalii</button>
                                            </a>

                                            <!--press to follow course-->

                                            @if (Auth::check())
                                                @if (!in_array(Auth::id(), $course->subscriptions->pluck('id')->toArray()))
                                                    <button type="submit" href="" class="btn btn-primary">Aboneaza-te
                                                    </button>
                                                @endif

                                                @if (in_array(Auth::id(), $course->users->pluck('id')->toArray()))
                                                    <a href="{{ url('/course/' . $course->slug . '/edit') }}"
                                                       class="btn btn-secondary">Editeaza</a>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </form>

                            @endforeach
                        </div>
                        <!--pagination-->

                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Inapoi</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">Inainte</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.filter-search-button').on('click', function () {

                $.blockUI({ css: { backgroundColor: '#fff', color: 'green'}, message: '<h4>Asteptati un moment...</h4>' });

                var yearFilter = parseInt($('.year-filter:checked').val());
                var semesterFilter = parseInt($('.semester-filter:checked').val());
                var subscriptionFilter = parseInt($('.subscription-filter:checked').val());

                $.ajax({
                    url: '/filter-courses',
                    type: 'get',
                    data: {yearFilter: yearFilter, semesterFilter: semesterFilter, subscriptionFilter: subscriptionFilter},
                    dataType: 'json', // ** ensure you add this line **
                    success: function(result) {

                        var html = '';

                        @if (Auth::check())
                            var user = JSON.parse(JSON.stringify(<?= Auth::user() ?>) );
                        @endif

                        jQuery.each(result, function(index, item) {
                            //now you can access properties using dot notation

                            var subscriptionIdList = [];
                            var courseUsersIdList = [];

                            jQuery.each(item.subscriptions, function(index, subscriptionItem) {
                                subscriptionIdList.push(subscriptionItem.id);
                            });

                            jQuery.each(item.users, function(index, userItem) {
                                courseUsersIdList.push(userItem.id);
                            });


                            html += '<form action="/course/'+ item.slug + '/subscribe" method="POST">';
                            html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">' ;
                            html += '<div class="card mb-3">' ;
                            html += '<div class="card-body text">';
                            html += '<h5 class="card-title">' + item.course_title + '</h5>' ;
                            html += '<p class="card-text">An: ' + item.year + '</p> ';
                            html += '<p class="card-text">Semestru: ' + item.semester + '</p>' ;
                            html += '<p class="card-text">Description: ' + item.description + '</p>' ;
                            html += '</div> <div class="card-footer bg-transparent border">';
                            html += '<a href="{{ url("/course/" . $course->slug) }}" class="btn btn-info">Detalii</a>';

                            @if (Auth::check())
                                if ($.inArray(user.id, subscriptionIdList) === -1) {
                                    html += '<button type="submit" class="btn btn-primary">Aboneaza-te </button>';
                                }

                                if ($.inArray(user.id, courseUsersIdList) !== -1) {
                                    html += '<a href="=/course/' + item.slug + '/edit"class="btn btn-secondary">Editeaza</a>';
                                }
                            @endif

                            html += '</div>';
                            html += '</div>';
                            html += '</form>';

                        });

                        $('.card-columns').html(html);
                        $.unblockUI();
                    }
                })
            });
        });
    </script>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@endsection