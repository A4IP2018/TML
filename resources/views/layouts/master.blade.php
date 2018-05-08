<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Description">
        <meta name="author" content="HomeworkManager Team">
        <title>Title</title>

        <!-- Bootstrap core CSS-->
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
        <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        @section('sidebar')
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <a class="navbar-brand" href="index.html">HomeworkManager</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                            <a class="nav-link" href="index.html">
                                <i class="fa fa-fw fa-dashboard"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                            <a class="nav-link" href="homework.html">
                                <i class="fa fa-fw fa-table"></i>
                                <span class="nav-link-text">Homework</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                            <a class="nav-link" href="upload.html">
                                <i class="fa fa-fw fa-file"></i>
                                <span class="nav-link-text">Upload</span>
                            </a>
                            <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                                <li>
                                    <a href="register.html">Registration Page</a>
                                </li>
                                <li>
                                    <a href="forgot-password.html">Forgot Password Page</a>
                                </li>
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                            <a class="nav-link" href="courses.html">
                                <i class="fa fa-fw fa-sitemap"></i>
                                <span class="nav-link-text">Courses</span>
                            </a>
                            <ul class="sidenav-second-level collapse" id="collapseMulti">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                                    <ul class="sidenav-third-level collapse" id="collapseMulti2">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav sidenav-toggler">
                        <li class="nav-item">
                            <a class="nav-link text-center" id="sidenavToggler">
                                <i class="fa fa-fw fa-angle-left"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-envelope"></i>
                                <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
                                <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">New Messages:</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="messages.html">
                                    <strong>Basescu</strong>
                                    <span class="small float-right text-muted">11:21 AM</span>
                                    <div class="dropdown-message small">Buna!</div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item small" href="messages.html">View all messages</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-bell"></i>
                                <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
                                <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">New Alerts:</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
                                    <span class="small float-right text-muted">11:21 AM</span>
                                    <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item small" href="#">View all alerts</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0 mr-lg-2">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Search for...">
                                    <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                                </div>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        @show

        @yield('content')

        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright © HomeworkManagerA4IP 2018</small>
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
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/main.min.js') }}"></script>
    </body>
</html>