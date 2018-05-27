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



<div class="container-fluid">
    <h2>Toate notele</h2>
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
                <td>{{ $grade->file->homework->course->course_title }}</td>
                <td>{{ $grade->file->homework->name }}</td>
                <td>{{ $grade->grade }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="page-break"></div>

<div class="container-fluid">
    <h2>Cursurile mele</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>Curs</th>
            <th>Profesori</th>
            <th>Nr Teme</th>
        </tr>
        </thead>
        <tbody>

        @foreach($myCourses as $myCourse)
            <tr>
                <td>{{ $myCourse->course_title }}</td>
                <td>{{ $myCourse->teacherNames }}</td>
                <td>{{ $myCourse->homeworks_count }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="page-break"></div>


</body>
</html>