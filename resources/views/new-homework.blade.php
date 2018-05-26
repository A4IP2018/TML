@extends('layouts.master')


@section('content')

<form action="{{ \Illuminate\Support\Facades\URL::to('homework') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="hw-title">Titlu:</label>
                <input type="text" name="name" class="form-control" id="hw-title"
                       placeholder="Alege un titlu">
            </div>
            <div class="form-group">

                <label for="sel1">Curs:</label>
                <select class="form-control" name="course" id="hw-curssel">
                    @if ($teacherCourses)
                       @foreach($teacherCourses as $teacherCours)
                            <option value="{{ $teacherCours->id }}">{{ $teacherCours->course_title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="hw-descr">Descriere:</label>
                <textarea class="form-control" name="description" rows="5" id="hw-descr"
                          placeholder="Alege o descriere"></textarea>
            </div>

            <div class="form-group row">

                <label for="deadline" class="col-1 col-form-label">Termen limita:</label>

                <!--Homework deadline-->
                <div class="col-10">
                    <input class="form-control" name="deadline" type="date" value="2018-08-19"
                           id="example-date-input">
                </div>
            </div>

            <br>
            <h5>Fisiere necesare</h5>
            <hr>
            <div class="filetype-selectots card-columns">
                <div class="card">
                    <div class="card-header">Fisier 1</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="file[0][file_description]">Descriere:</label>
                            <textarea class="form-control" type="text" rows="3"  maxlength="240" placeholder="Introdu o scurta descirere a fisierului" name="file[0][file_description]"></textarea>
                            <br>
                            <label for="file[0][file_format]">Format:</label>
                            <select name="file[0][file_format]" class="form-control">
                                @if ($formats)
                                    @foreach ($formats as $format)
                                        <option value="{{ $format->id }}">{{ $format->extension_name }}</option>
                                    @endforeach
                                 @else
                                    <option>Plain Text</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary add-more-files" type="button" >Mai multe fisiere</button>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary ">Salveaza
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var globalCounter = 0;
            $(document).on('click', '.add-more-files', function(element) {
                globalCounter += 1;
                var original = element.target.parentElement.parentElement;
                var newNode = original.cloneNode(true);
                console.log(newNode.innerHTML.search(/file-description-\d+/));
                newNode.innerHTML  = newNode.innerHTML.replace(/file\[\d+\]/g, 'file[' + globalCounter.toString() + ']');
                newNode.innerHTML  = newNode.innerHTML.replace(/Fisier \d+/g, 'Fisier ' + globalCounter.toString());
                console.log(newNode);
                original.parentElement.appendChild(newNode);

            });
        });
    </script>
@endsection