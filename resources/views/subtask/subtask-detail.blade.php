@extends('layout.app')
@section('title', 'Chi tiết công việc')
@section('css')
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css') }}">
    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/assets/icon/simple-line-icons/css/simple-line-icons.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">
@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            {{-- <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Task detail</h4>
                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">SubTask</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">SubTask-Detail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <!-- Task-detail-right start -->
            <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-clock-time m-r-10"></i>Thời gian còn lại</h5>
                    </div>
                    <div class="card-block">
                        <div class="counter">
                            <div class="yourCountdownContainer">
                                <div class="row text-center" id="countdown">
                                    <div class="col-xs-3">
                                        <h2 id="days">0</h2>
                                        <p>Days</p>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 id="hours">0</h2>
                                        <p>Hours</p>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 id="minutes">0</h2>
                                        <p>Minutes</p>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 id="seconds">0</h2>
                                        <p>Seconds</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="card-footer">
                        <div class="f-left">
                            @if($subtask->Status === 'Active')
                                <i class="icofont icofont-pause text-warning"></i>
                            @elseif($subtask->Status === 'OnHold')
                                <i class="icofont icofont-pause text-secondary"></i>
                            @elseif($subtask->Status === 'Resolved')
                                <i class="icofont icofont-check text-success"></i>
                            @elseif($subtask->Status === 'Closed')
                                <i class="icofont icofont-lock text-danger"></i>
                            @else
                                <i class="icofont icofont-question text-muted"></i>
                            @endif
                        </div>
                        <div class="f-right">
                            <div class="dropdown-secondary dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-light" type="button"
                                    id="dropdown2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{$subtask->Status}}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown2"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <a class="dropdown-item waves-light waves-effect @if($subtask->Status === 'InProgress') active @endif" href="#!">InProgress</a>
                                    <a class="dropdown-item waves-light waves-effect @if($subtask->Status === 'Pending') active @endif" href="#!">Pending</a>
                                    <a class="dropdown-item waves-light waves-effect @if($subtask->Status === 'Blocked') active @endif" href="#!">Blocked</a>
                                    <a class="dropdown-item waves-light waves-effect @if($subtask->Status === 'Completed') active @endif" href="#!">Completed</a>
                                    <div class="dropdown-divider"></div>
                                    {{-- <a class="dropdown-item waves-light waves-effect" href="#!">Duplicate</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-ui-note m-r-10"></i>Chi tiết nhiệm vụ</h5>
                    </div>
                    <div class="card-block task-details">
                        <table class="table table-border table-xs">
                            <tbody>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Nhiệm vụ:</td>
                                    <td class="text-right"><span class="f-right"><a href="#">
                                                {{ $subtask->SubTaskName }}</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Bắt đầu:</td>
                                    <td class="text-right">{{ $subtask->StartDate->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Kết thúc:</td>
                                    <td class="text-right">{{ $subtask->DueDate->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Trạng thái:</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="#">
                                                {{ $subtask->Status }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Người phụ trách:</td>
                                    <td class="text-right"><a href="">{{ $subtask->user->FullName }}</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div>
                            {{-- <span>
                                <a href="#!" class="text-muted m-r-10 f-16"><i class="icofont icofont-random"></i>
                                </a>
                            </span>
                            <span class="m-r-10">
                                <a href="#!" class="text-muted f-16"><i class="icofont icofont-options"></i></a>
                            </span> --}}
                            <div class="dropdown-secondary dropdown d-inline-block">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-light" type="button"
                                    id="dropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="icofont icofont-navigation-menu"></i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdown3" data-dropdown-in="fadeIn"
                                    data-dropdown-out="fadeOut">
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-checked m-r-10"></i>Bắt đầu</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-edit-alt m-r-10"></i>Chỉnh sửa</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-close m-r-10"></i>Xóa</a>
                                </div>
                                <!-- end of dropdown menu -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-attachment"></i> Tài liệu nhiệm vụ</h5>
                    </div>
                    <div class="card-block task-attachment">
                        <ul class="media-list">
                            @foreach ($subtask->subtaskfiles as $subtaskfile)
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <i class="icofont icofont-file-word f-28 text-muted"></i>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="m-b-5 d-block">{{ $subtaskfile->filename }}</a>
                                        <div class="text-muted">
                                            {{-- <span>Size: 1.2Mb</span> --}}
                                            <span>
                                                Thêm bởi <a
                                                    href="">{{ $subtaskfile->with('user')->get()->find($subtaskfile->id)->user->FullName }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <i class="icofont icofont-download-alt f-18"></i>
                                    </div>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Task-detail-right start -->
            <!-- Task-detail-left start -->
            <div class="col-xl-8 col-lg-12 pull-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="icofont icofont-tasks-alt m-r-5"></i> Chi tiết nội dung nhiệm vụ</h5>
                        {{-- <button class="btn btn-sm btn-primary f-right"><i class="icofont icofont-ui-alarm"></i>Check
                            in</button> --}}
                    </div>
                    <div class="card-block">
                        <div class="">
                            <div class="m-b-20 col-sm-12">
                                <div class="row">
                                    {{ $subtask->Description }}
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
            <!-- Task-detail-left end -->
        </div>
    </div>
    <!-- Page-body end -->
@endsection
@section('scripts')
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

    <!-- counter js -->
    <script src="{{ asset('files/bower_components/countdown/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('files/assets/pages/counter/task-detail.js') }}"></script>
    <!-- Switch component js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/switchery/js/switchery.min.js') }}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}">
    </script>
    <script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/vartical-layout.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!--<script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/swithces.js') }}"></script>-->
    <script>
        // Multiple switches
        var elem = Array.prototype.slice.call(document.querySelectorAll('.js-small'));

        elem.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#1abc9c',
                jackColor: '#fff',
                size: 'small'
            });
        });
    </script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('files/assets/js/script.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-23581568-13');
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy ngày bắt đầu và kết thúc từ backend
            const status = @json($subtask->Status); 
            const startDate = new Date(@json($subtask->StartDate)).getTime();
            const endDate = new Date(@json($subtask->Duedate)).getTime();
            const now = new Date().getTime();
    
            // Kiểm tra trạng thái
            if (status !== 'Active' || now < startDate || now > endDate) {
                // Dự án chưa bắt đầu hoặc đã kết thúc
                document.getElementById('days').innerText = 0;
                document.getElementById('hours').innerText = 0;
                document.getElementById('minutes').innerText = 0;
                document.getElementById('seconds').innerText = 0;
            } else {
                // Bắt đầu đếm ngược
                const countdownInterval = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = endDate - now;
    
                    if (distance <= 0) {
                        clearInterval(countdownInterval);
                        document.getElementById('days').innerText = 0;
                        document.getElementById('hours').innerText = 0;
                        document.getElementById('minutes').innerText = 0;
                        document.getElementById('seconds').innerText = 0;
                        return;
                    }
    
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
                    document.getElementById('days').innerText = days;
                    document.getElementById('hours').innerText = hours;
                    document.getElementById('minutes').innerText = minutes;
                    document.getElementById('seconds').innerText = seconds;
                }, 1000);
            }
        });
    </script>
@endsection
