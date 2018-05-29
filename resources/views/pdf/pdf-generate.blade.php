<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Description">
    <meta name="author" content="HomeworkManager Team">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>TML</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <style>

        .page-break {
            page-break-after: always;
        }

        <?php include(public_path().'/css/main.css');?>
        <?php include(public_path().'/vendor/bootstrap/css/bootstrap.min.css');?>
        <?php include(public_path().'/vendor/font-awesome/css/font-awesome.min.css');?>
    </style>

</head>
<body>


@if ($grades && count($grades) > 0)
<div class="container-fluid">
    <h2>Notele mele</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Curs</th>
            <th>Tema</th>
            <th>Nota</th>
        </tr>
        </thead>
        <tbody>

        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->homework->course->course_title }}</td>
                <td>{{ $grade->homework->name }}</td>
                <td>{{ $grade->grade }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="page-break"></div>
@endif

@if ($myCourses && count($myCourses) > 0)

<div class="container-fluid">
    <h2>Cursurile mele</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Curs</th>
            <th>Profesori</th>
            <th>Nr Teme</th>
            @if (is_teacher())
                <th>Nr picati</th>
                <th>Nr trecuti</th>
                <th>Nr studenti abonati</th>
            @endif
        </tr>
        </thead>
        <tbody>

        @foreach($myCourses as $myCourse)
            <tr>
                <td>{{ $myCourse->course_title }}</td>
                <td>{!! implode('<br>' ,explode(', ', $myCourse->teacherNames)) !!}</td>
                <td>{{ $myCourse->homeworks_count }}</td>
                @if (is_teacher())
                    <td>{{ $myCourse->failedStudents }}</td>
                    <td>{{ $myCourse->passedStudents }}</td>
                    <td>{{ $myCourse->subscriptionsStudents }}</td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="page-break"></div>
@endif

@if ($allGrades && count($allGrades) > 0 && is_administrator())

<div class="container-fluid">
    <h2>Toate notele</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Persoana</th>
            <th>Curs</th>
            <th>Tema</th>
            <th>Nota</th>
        </tr>
        </thead>
        <tbody>

        @foreach($allGrades as $grade)
            <tr>
                @if ($grade->user->student_information)
                    <td>{{ $grade->user->student_information->nr_matricol }}</td>
                @else
                    <td>{{ $grade->user->teacher_information->name }}</td>
                @endif
                {{ dd($grade) }}
                <td>{{ $grade->homework->course->course_title }}</td>
                <td>{{ $grade->homework->name }}</td>
                <td>{{ $grade->grade }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="page-break"></div>
@endif

</body>
</html>