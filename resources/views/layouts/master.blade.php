<?php

    $notifications = null;
    if (Auth::check()) {
        $notifications = App\Notification::where('user_id', Auth::id())->where('seen', false)->orderBy('created_at', 'DESC')->get();
        if ($notifications->count() > 5) {
            $notifications = $notifications->take(5);
        }
        if ($notifications->count() == 0) {
            $notifications = null;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Description">
        <meta name="author" content="HomeworkManager Team">
        <title>TML</title>

        <!-- Bootstrap core CSS-->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css?v='. time()) }}" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="{{ asset('css/main.css?v='. time()) }}" rel="stylesheet">

    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top" >
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">

            <a class="navbar-brand" href="/">
                <img src="{{ URL::asset('favicon.ico') }}" class="img-fluid" style="max-width: 15%;max-height: 15%">
                TeMeLe
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">


                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
                        <a class="nav-link" href="{{ url('/profile') }}">
                            <i class="fa fa-fw fa-link"></i>
                            <span class="nav-link-text">Profil</span>
                        </a>
                    </li>

                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                        <a class="nav-link" href="{{ url('/course') }}">
                            <i class="fa fa-fw fa-sitemap"></i>
                            <span class="nav-link-text">Cursuri</span>
                        </a>
                    </li>

                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                        <a class="nav-link" href="{{ url('/homework') }}">
                            <i class="fa fa-fw fa-table"></i>
                            <span class="nav-link-text">Teme</span>
                        </a>
                    </li>

                    @if (!is_teacher())
                    <li class="nav-item" data-toggle="tooltip" data-placement="right">
                        <!--student uploads for this homework <TEACHER>-->
                        <a class="nav-link" href="{{ url('/upload') }}">
                            <i class="fa fa-fw fa-upload"></i>
                            <span class="nav-link-text">Teme &#238;nc&#259;rcate</span>
                        </a>
                    </li>
                    @endif

                    @if (is_teacher())
                    <li class="nav-item" data-toggle="tooltip" data-placement="right">
                        <a class="nav-link" href="{{ url('/compare') }}">
                            <i class="fa fa-fw fa-book"></i>
                            <span class="nav-link-text">Compar&#259;</span>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item" data-toggle="tooltip" data-placement="right">
                        <a class="nav-link" href="{{ url('/contact') }}">
                            <i class="fa fa-fw fa-address-book"></i>
                            <span class="nav-link-text">Contact</span>
                        </a>
                    </li>

                    <li class="nav-item" data-toggle="tooltip" data-placement="right">
                        <a class="nav-link" href="{{ url('/about') }}">
                            <i class="fa fa-fw fa-connectdevelop"></i>
                            <span class="nav-link-text">Despre</span>
                        </a>
                    </li>

                    @if(Auth::check())
                       <li class="nav-item" data-toggle="tooltip" data-placement="right">
                            <a class="nav-link" href="{{ url('/pdf-generator') }}">
                                <i class="fa fa-fw fa-connectdevelop"></i>
                                <span class="nav-link-text">Generare statistici</span>
                            </a>
                        </li>
                    @endif

                </ul>
                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav ml-auto">
                    @if (Auth::check())

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-bell"></i>
                            <span class="d-lg-none">Notific&#259;ri
                              <span class="badge badge-pill badge-warning">{{ (!is_null($notifications) ? $notifications->count() . ' noi' : '') }}</span>
                            </span>
                            @if (!is_null($notifications))
                            <span class="indicator text-warning d-none d-lg-block">
                              <i class="fa fa-fw fa-circle"></i>
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu" aria-labelledby="alertsDropdown" style="margin-left:-50px">
                            @if (!is_null($notifications))
                                <h6 class="dropdown-header">Notific&#259;ri noi:</h6>
                                <div class="dropdown-divider"></div>
                                @foreach ($notifications as $notification)
                                <a class="dropdown-item small text-muted" href="{{ url('/notifications') }}">
                                    {{ $notification->created_at }}
                                </a>

                                <div class="dropdown-item small">
                                    {!! html_entity_decode($notification->message) !!}
                                </div>
                                <div class="dropdown-divider"></div>
                                @endforeach

                            @else
                                <span class="small text-muted dropdown-item">Nu ai notificari noi</span>
                            @endif
                            <a class="dropdown-item small" href="{{ url('/notifications') }}">Vizualizeaza toate</a>
                        </div>
                    </li>
                    @endif
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link mr-lg-2" id="changeThemeColor" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--<i class="fa fa-fw fa-moon-o"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    @if (Auth::check())
                        <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-fw fa-sign-out"></i>Deconectare</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">&#206;nregistrare</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Logare</a></li>
                    @endif

                    @if (Auth::check() and Auth::user()->role->rank == \App\Role::$ADMINISTRATOR_RANK)
                        <li class="nav-item"><a class="nav-link" href="{{ url('/admin') }}">Administrare</a></li>
                    @endif

                </ul>
            </div>
        </nav>
        <!--ABOUT PAGE-->
        <div class="content-wrapper">
            <div class="container-fluid p-4">
                @if (isset($errors) and $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{!! $error !!} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::get('message'))
                    <div class="alert alert-info alert-dismissible fade show">
                        {!! Session::get('message') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {!! Session::get('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {!! Session::get('error') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>

        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright © TeMeLe-A4IP 2018</small>
                </div>
            </div>
        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->

        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/main.min.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.min.js') }}"></script>

        <script>
            $('#changeThemeColor').click(function() {
                $('nav').toggleClass('navbar-dark navbar-light');
                $('nav').toggleClass('bg-dark bg-light');
                $('body').toggleClass('bg-dark bg-light');
            });
        </script>

        <link rel="stylesheet" href="{{ asset('vendor/highlight/styles/default.css') }}">
        <script src="{{ asset('vendor/highlight/highlight.pack.js') }}"></script>
        <script src="{{ asset('vendor/highlightjs-line-numbers.js/dist/highlightjs-line-numbers.min.js') }}"></script>
        <script>
            $(document).ready(function() {

                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });

                $('pre code').each(function(i, block) {
                    hljs.lineNumbersBlock(block);
                });
            });
        </script>


        <script>
            $("input.custom-file-input").change(function () {

                var fieldVal = $(this).val();
                // Change the node's value by removing the fake path (Chrome)
                fieldVal = fieldVal.replace("C:\\fakepath\\", "");

                console.log();
                if (fieldVal != undefined || fieldVal != "") {
                    $(this).parent().find('.custom-file-label').html(fieldVal);
                }

            });
        </script>

        @yield('scripts')
    </body>
</html>