@extends('layouts.master')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="input-group">
            <input name="course-search" class="course-search form-control" type="text" placeholder="Cauta curs...">
            <span class="input-group-append">
                <button data-toggle="collapse" data-target="#demo" class="btn btn-secondary">Filtru <i class="fa fa-filter"></i></button>
                <button class="btn btn-primary filter-search-button" type="button">
                <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        <br>
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

        @if (is_teacher() or is_administrator())
            <!--Press to create new Course-->
            <br><a href="{{ url('/course/create') }}" class="btn btn-primary btn-lg btn-block">Curs nou</a>
        @endif
        <!--Multiple Courses-->
        <div class="mb-0 mt-4">

            <div class="card-columns" style="column-count: 3">
            @foreach ($courses as $course)
                <!-- Example Course Card-->
                <form action="{{ url("/course/" . $course->slug . "/subscribe") }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card mb-3">
                        <div class="card-body text">
                            <h5 class="card-title">{{ $course->course_title }}</h5>
                            <p class="card-text">An: {{ $course->year }}</p>
                            <p class="card-text">Semestru: {{ $course->semester }}</p>

                            <p class="card-text">Descriere: {{ $course->description }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group">
                                <!--press to be sent to the course page-->
                                <a href="{{ url('/course/' . $course->slug) }}" class="btn btn-info">Detalii</a>

                                <!--press to follow course-->
                                @if (can_subscribe($course->id))
                                    <button type="submit" class="btn btn-primary">Aboneaz&#259;-te
                                    </button>
                                @endif

                                @if (is_course_teacher($course->id))
                                    <a href="{{ url('/course/' . $course->slug . '/edit') }}"
                                       class="btn btn-secondary">Editeaz&#259;</a>
                                @endif
                            </div>
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

@endsection

@section ('scripts')

    <script>
        $(document).ready(function () {
            $('.filter-search-button').on('click', function () {

                $.blockUI({ css: { backgroundColor: '#fff', color: 'green'}, message: '<h4>Asteptati un moment...</h4>' });

                var yearFilter = parseInt($('.year-filter:checked').val());
                var semesterFilter = parseInt($('.semester-filter:checked').val());
                var courseSearchFilter = $('.course-search').val();
                var subscriptionFilter = parseInt($('.subscription-filter:checked').val());

                $.ajax({
                    url: '/filter-courses',
                    type: 'get',
                    data: {courseSearchFilter: courseSearchFilter, yearFilter: yearFilter, semesterFilter: semesterFilter, subscriptionFilter: subscriptionFilter},
                    dataType: 'json',
                    success: function(result) {
                        var html = '';

                        jQuery.each(result, function(index, item) {

                            html +=
                                '<form action="' + item.subscribe_url + '" method="POST">\n' +
                                '<input type="hidden" name="_token" value="{{ csrf_token() }}">\n' +
                                '<div class="card mb-3">\n' +
                                '<div class="card-body text">\n' +
                                '<h5 class="card-title">' + item.course_title + '</h5>\n' +
                                '<p class="card-text">An: ' + item.year + '</p>\n' +
                                '<p class="card-text">Semestru: ' + item.semester + '</p>\n' +
                                '<p class="card-text">Description: ' + item.description + '</p>\n' +
                                '</div>\n' +
                                '<div class="card-footer bg-transparent border">\n' +
                                '<div class="btn-group">\n' +
                                '<a href="' + item.detail_url + '" class="btn btn-info">Detalii</a>\n';

                            if (item.can_subscribe) {
                                html +=
                                    '<button type="submit" class="btn btn-primary">Aboneaza-te\n' +
                                    '</button>\n';
                            }
                            if (item.is_teacher) {
                                html +=
                                    '<a href="' + item.edit_url + '"\n' +
                                    'class="btn btn-secondary">Editeaza</a>\n';
                            }
                            html +=
                                '</div>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</form>';
                        });

                        $('.card-columns').html(html);
                        $.unblockUI();
                    }
                })
            });
        });
    </script>

@endsection