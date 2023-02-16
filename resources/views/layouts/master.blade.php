<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KFUEIT CMS | @yield('page_title')</title>
    <link rel="shortcut icon" href="https://kfueit.edu.pk/vendor/core/images/favicon.png">
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('master-demo/assets')}}/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/css/colors.min.css" rel="stylesheet" type="text/css">

    <link href="{{asset('master-demo/assets')}}/css/custom.css" rel="stylesheet" type="text/css">
    <link href="{{asset('master-demo/assets')}}/css/summernote.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"
          type="text/css">


    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
    <style>
        #custom_table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #custom_table td, #custom_table th {
            border: 1px solid #ddd;
            padding: 1px;
            word-break:normal;
        }

        #custom_table tr:nth-child(even){background-color: #f2f2f2;}

        #custom_table tr:hover {background-color: #ddd;}

        #custom_table th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        #custom_table .check-column
        {
            width: 2em;
        }

    </style>

    <script>
        var PRODUCT_IMAGE = "{{ asset('storage/media/') }}";
    </script>

    <!-- /global stylesheets -->
</head>
<style>
    .sidebar-dark .nav-sidebar .nav-item > .nav-link.active {
        background-color: #3e495f;
        color: #fff;
    }
</style>
@yield('custom_css')

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="#" class="d-inline-block">
            <img src="{{asset('master-demo/images/')}}/logo_light.png" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>


        </ul>

        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">
            <li class="nav-item dropdown" style="display: none">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-people"></i>
                    <span class="d-md-none ml-2">Users</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-300">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Users online</span>
                        <a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Jordana Ansley</a>
                                    <span class="d-block text-muted font-size-sm">Lead web developer</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                        class="badge badge-mark border-success"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Will Brason</a>
                                    <span class="d-block text-muted font-size-sm">Marketing manager</span>
                                </div>
                                <div class="ml-3 align-self-center"><span class="badge badge-mark border-danger"></span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Hanna Walden</a>
                                    <span class="d-block text-muted font-size-sm">Project manager</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                        class="badge badge-mark border-success"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Dori Laperriere</a>
                                    <span class="d-block text-muted font-size-sm">Business developer</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                        class="badge badge-mark border-warning-300"></span></div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <a href="#" class="media-title font-weight-semibold">Vanessa Aurelius</a>
                                    <span class="d-block text-muted font-size-sm">UX expert</span>
                                </div>
                                <div class="ml-3 align-self-center"><span
                                        class="badge badge-mark border-grey-400"></span></div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer bg-light">
                        <a href="#" class="text-grey mr-auto">All users</a>
                        <a href="#" class="text-grey"><i class="icon-gear"></i></a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown" style="display: none">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="d-md-none ml-2">Messages</span>
                    <span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">2</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Messages</span>
                        <a href="#" class="text-default"><i class="icon-compose"></i></a>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list">
                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">James Alexander</span>
                                            <span class="text-muted float-right font-size-sm">04:58</span>
                                        </a>
                                    </div>

                                    <span
                                        class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3 position-relative">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Margo Baker</span>
                                            <span class="text-muted float-right font-size-sm">12:16</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">That was something he was unable to do because...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Jeremy Victorino</span>
                                            <span class="text-muted float-right font-size-sm">22:48</span>
                                        </a>
                                    </div>

                                    <span
                                        class="text-muted">But that would be extremely strained and suspicious...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Beatrix Diaz</span>
                                            <span class="text-muted float-right font-size-sm">Tue</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                </div>
                            </li>

                            <li class="media">
                                <div class="mr-3">
                                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" width="36"
                                         height="36" class="rounded-circle" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-title">
                                        <a href="#">
                                            <span class="font-weight-semibold">Richard Vango</span>
                                            <span class="text-muted float-right font-size-sm">Mon</span>
                                        </a>
                                    </div>

                                    <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-content-footer justify-content-center p-0">
                        <a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip" title="Load more"><i
                                class="icon-menu7 d-block top-0"></i></a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('master-demo/images')}}/placeholders/placeholder.jpg" class="rounded-circle mr-2"
                         height="34" alt="">
                    <span>{{auth()->user()->name}}</span>
                </a>

                @php

                    $check_roll_back_action = \Session::get('show_rollback_action');
                    $roll_back_user = \Session::get('previous_user');

                @endphp


                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    @if($check_roll_back_action)
                        <a href="{{route('login.roll.back.user',$roll_back_user)}}" class="dropdown-item"><i
                                class="icon-user-plus"></i>
                            Roll Back Login</a>
                    @endif
                    <a href="{{route('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->
        @include('layouts.sidebar')

        {{---
            @if(Auth::check() && Auth::user()->teacher_id>0)
                @include('layouts.teacher-sidebar')
            @else
                @include('layouts.sidebar')
            @endif
            ---}}



        {{--            @include('layouts.sidebar')--}}


    </div>
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><a style="color: unset !important" href="{{ url()->previous() }}"><i
                                class="icon-arrow-left52 mr-2"> </i></a> <span class="font-weight-semibold">Home</span>
                        - Dashboard</h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-center">
                        @yield('top_buttons')
                    </div>
                </div>
            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{route('academic.session')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>
                            Home</a>
                        <span class="breadcrumb-item active">Dashboard</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">


                    <div class="breadcrumb justify-content-center">

                        @yield('reports_btn')

                    </div>

                    <div class="breadcrumb justify-content-center">

                        @yield('action_btn')
                    </div>
                </div>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">


            @yield('content')


        </div>
        <!-- /content area -->


        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                        data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2015 - <script>document.write(new Date().getFullYear())</script>. <a href="#">KFUEIT, ICT Department</a>
					</span>

                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item"><a href="mailto:software.support@kfueit.edu.pk" class="navbar-nav-link"
                                            target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                    <li class="nav-item"><a href="/uploads/CMS Manual.pdf" class="navbar-nav-link" target="_blank"><i
                                class="icon-file-text2 mr-2"></i> Docs</a></li>

                </ul>
            </div>
        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->


<form id="frmMngEnrol">
    <input type="hidden" id="data_filter" name="data_filter"/>
    @csrf
</form>

<input type="hidden" value="{{url('/')}}" id="url" name="url">

</body>
</html>


<!-- Core JS files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('master-demo/global_assets/js/main/jquery.min.js') }}"></script>
<script src="{{ asset('master-demo//global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('master-demo/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>

<script src="{{asset('master-demo')}}/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>

<script src="{{asset('master-demo/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>

<script src="{{asset('master-demo/global_assets/js/demo_pages/form_select2.js')}}"></script>

<script src="{{asset('master-demo/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>


<script src="{{asset('master-demo/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/pickers/anytime.min.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/notifications/jgrowl.min.js')}}"></script>

<script src="{{asset('master-demo/global_assets/js/demo_pages/picker_date.js')}}"></script>

<script src="{{asset('master-demo/assets/js/app.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/demo_pages/form_inputs.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/demo_pages/form_input_groups.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/editors/summernote/summernote.min.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('master-demo/global_assets/js/demo_pages/editor_summernote.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('master-demo/assets/js/custom.js')}}"></script>

<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

@yield('filepond_section')

<script>

    $(document).ready(function () {
        var dark = $('.content');

        $(document).ajaxStart(function () {

            $(dark).block({
                message: '<i class="icon-spinner spinner"></i>',
                overlayCSS: {
                    backgroundColor: '#1B2024',
                    opacity: 0.50,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none',
                    color: '#fff'
                }
            });
        });
        $(document).ajaxComplete(function () {
            $(dark).unblock();
        });
    });

</script>

@yield('custom_js')

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var href = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                    Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                    )
                }
            })


        });
    });


    $('.editor').summernote({
        placeholder: 'Enter Detail',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });


    @if(Session::has('message'))
    var type = "{{Session::get('alert-type', 'success')}}"
    toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    switch (type) {
        case 'info':
            toastr.info("{{ session('message') }}");
            break;

        case 'success':
            toastr.success("{{ session('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ session('message') }}");
            break;

        case 'error':
            toastr.error("{{ session('message') }}");
            break;
    }
    @endif

</script>



