@extends('layouts.master')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <!--search for homework-->
                <input name="homework-search" class="homework-search form-control" type="text" placeholder="Cauta tema...">
                <span class="input-group-append">
                <button data-toggle="collapse" data-target="#demo" class=" btn btn-secondary ">Filtru <i
                            class="fa fa-filter"></i></button>
                <button class="filter-search-button btn btn-primary" type="button">
                <i class="fa fa-search"></i>
                </button>
            </span>
            </div>
            <br>
            <div id="demo" class="collapse">
                <div class="card">
                    <div class="card-body">
                        @if (is_teacher())
                            <form>
                                <h6>Teme:&nbsp; </h6>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="unchecked-homework" value="1">
                                    <span>Necorectate</span>
                                </label> &ensp;
                            </form>
                            <hr>
                            <form>
                                <h6>Cursuri:</h6>

                                <select class="course form-control" name="courses" id="courses">
                                    <option value="-1">Alege un curs</option>
                                    @foreach (Auth::user()->courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                                    @endforeach
                                </select>


                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <br>
            @if (Auth::check() and is_teacher() and Auth::user()->courses->count() > 0)
                <a href="{{ url('/homework/create') }}" class="btn btn-primary btn-lg btn-block">Tema noua</a>
                <hr class="mt-2">
            @endif

            @if ($homeworks->count() > 0)
                <div class="card-columns">
                    @foreach ($homeworks as $homework)
                        <div class="">
                        <div class="card mb-3">
                            <div class="card-header bg-transparent">
                                <a href="{{ url('/course/' . $homework->course->slug) }}">{{ $homework->course->course_title }}</a>
                            </div>

                            <div class="card-body text">
                                <h5 class="card-title">{{ $homework->name }}</h5>
                                <p class="card-text">{{ $homework->description }}</p>
                            </div>

                            <div class="card-footer bg-transparent">
                                <span>Termen limita:</span>
                                {{ $homework->deadline }}
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ url('/homework/' . $homework->slug) }}" class="btn btn-info">
                                    <span>Detalii</span>
                                </a>
                                @if (Auth::check() and is_homework_author($homework))
                                    <a href="{{ url('/homework/' . $homework->slug . '/edit') }}" class="btn btn-secondary">
                                        <span>Editeaza</span>
                                    </a>

                                    <a class="btn btn-primary" href="{{ url('/uploads/unchecked/' . $homework->slug) }}">
                                        <span>Necorectate</span> <span class="badge badge-light">{{ $homework->files_count - $homework->grades_count }}</span>
                                    </a>

                                    <a class="btn btn-primary" href="{{ url('/uploads/checked/' . $homework->slug) }}">
                                        <span>Corectate</span> <span class="badge badge-light">{{ $homework->grades_count }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        </div>
                    @endforeach

                </div>
            @else
                <h4 class="text-center">Nicio tem&#259; aici, &#238;ncearca s&#259; te abonezi la c&#226;teva <a
                            href="{{ url('/course') }}">cursuri</a>
                    @if (is_teacher())
                        sau sa
                        <a href="{{ url('/homework/create') }}">creezi</a> una
                    @endif
                </h4>
        @endif


        <!--pagination

        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Inapoi</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">Inainte</a></li>
        </ul>
        --->
        </div>
    </div>
@endsection

@section ('scripts')

    <script>
        $(document).ready(function () {
            $('.filter-search-button').on('click', function () {

                $.blockUI({css: {backgroundColor: '#fff', color: 'green'}, message: '<h4>Asteptati un moment...</h4>'});

                var courseFilter = parseInt($('.course').val());
                var homeworkSearchFilter = $('.homework-search').val();
                var uncheckedHomeworkFilter = parseInt($('.unchecked-homework:checked').val());

                $.ajax({
                    url: '/filter-homework',
                    type: 'get',
                    data: {courseFilter: courseFilter, uncheckedHomeworkFilter: uncheckedHomeworkFilter, homeworkSearchFilter: homeworkSearchFilter},
                    dataType: 'json',
                    success: function (result) {
                        var html = '';

                        jQuery.each(result, function (index, item) {

                            html +=
                                '<div class="">' +
                                '<div class="card mb-3">' +
                                    '<div class="card-header bg-transparent">' +
                                        '<a href="'+ item.course_link +'">' + item.course.course_title + '</a>' +
                                    '</div>' +

                                    '<div class="card-body text">' +
                                        '<h5 class="card-title">' + item.name + '</h5>' +
                                        '<p class="card-text">'+ item.description +'</p>' +
                                    '</div>' +

                                    '<div class="card-footer bg-transparent">' +
                                        '<span>Termen limita:</span> '+ item.deadline +
                                    '</div>' +

                                    '<div class="card-footer bg-transparent border">' +
                                        ' <a href="'+ item.homework_link +'" class="btn btn-info">' +
                                            '<span>Detalii</span>' +
                                        '</a>';

                                    if (item.is_homework_author) {
                                        html +=
                                        '<a href="'+ item.homework_edit +'" class="btn btn-secondary">' +
                                            '<span>Editeaza</span>' +
                                        '</a>'+

                                        '<a class="btn btn-primary" href="'+ item.unchecked_homework_link +'">'+
                                            '<span>Necorectate</span> <span class="badge badge-light">'+ (item.files_count - item.grades_count) +'</span>'+
                                        '</a>'+

                                        '<a class="btn btn-primary" href="'+ item.checked_homework_link +'">'+
                                            '<span>Corectate</span> <span class="badge badge-light">'+ item.grades_count +'</span>'+
                                        '</a>';
                                    }

                            html +=
                                    '</div>' +
                                '</div>' +
                                '</div>'
                        });

                        $('.card-columns').html(html);
                        $.unblockUI();
                    }
                })
            });
        });
    </script>

@endsection