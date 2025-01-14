@extends('admin.layout')

@section('css')
    <!-- Favicon icon -->
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- radial chart.css -->
    <link rel="stylesheet" href="..\files\assets\pages\chart\radial\css\radial.css" type="text/css" media="all">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\font-awesome\css\font-awesome.min.css">
@endsection
@section('content')
    <div class="row">
        <!-- statustic-card start -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-yellow text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Dự án</p>
                            <h4 class="m-b-0">{{ $projects->count() }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-folder f-50 text-c-yellow"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-green text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Công việc</p>
                            <h4 class="m-b-0">{{ $tasks->count() }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-list f-50 text-c-green"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-pink text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Nhiệm vụ</p>
                            <h4 class="m-b-0">{{ $subtasks->count() }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-file f-50 text-c-pink"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-blue text-white">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5">Người dùng</p>
                            <h4 class="m-b-0">{{ $users->count() }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-user f-50 text-c-blue"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- statustic-card start -->

        <!-- statustic-card start -->
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Dự án</h4>
                    {{-- <span>Dưới đây là các dự án của bạn</span> --}}

                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên dự án</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects->slice(0, 5) as $project)
                                    <tr>
                                        <th scope="row">{{ $project->ProjectId }}</th>
                                        <td><a href="">{{ $project->ProjectName }}</a></td>
                                        <td>{{ $project->EndDate ? $project->EndDate->format('d-m-Y') : '' }}</td>
                                        <td>
                                            @php
                                                $statusClass = match ($project->Status) {
                                                    'Active' => 'label-primary', // Màu xanh dương
                                                    'Planned' => 'label-info', // Màu xanh nhạt
                                                    'OnHold' => 'label-danger', // Màu đỏ
                                                    'Archived' => 'label-success', // Màu xanh lá
                                                    'Completed' => 'label-success', // Màu xanh lá
                                                    default => 'label-default', // Màu mặc định
                                                };
                                            @endphp

                                            <label class="label {{ $statusClass }}">{{ ucfirst($project->Status) }}</label>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card feed-card">
                <div class="card-header">
                    <h5>Người dùng</h5>
                </div>
                <div class="card-block">
                    @foreach ($users->slice(0, 5) as $user)
                        <div class="row m-b-30">
                            <div class="col-auto p-r-0" style="display: flex; align-item: center;">
                                <i class="feather icon-bell bg-simple-c-blue feed-icon"></i>
                            </div>
                            <div class="col">
                                <h6 class="m-b-5">{{ $user->FullName }}
                                    {{-- <span class="text-muted f-right f-13">
                                        {{ \Carbon\Carbon::parse($user->CreatedAt)->diffForHumans() }}
                                    </span> --}}
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!-- statustic-card start -->



        <!-- ticket and update start -->
        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Công việc ưu tiên</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Độ ưu tiên</th>
                                    <th>Tên công việc</th>
                                    <th>Dự án</th>
                                    <th>Thời gian còn lại</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks->slice(0, 10) as $task)
                                    <tr>
                                        <td>{{ $task->TaskId }}</td>
                                        <td>
                                            @php
                                                $statusClass = match ($task->Priority) {
                                                    'High' => 'label-danger',
                                                    'Medium' => 'label-warning',
                                                    default => 'label-success',
                                                };
                                            @endphp

                                            <label
                                                class="label {{ $statusClass }}">{{ ucfirst($task->Priority) }}</label>
                                        </td>
                                        <td>{{ $task->TaskName }}</td>
                                        <td>{{ $task->project->ProjectName }}</td>
                                        <td>
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $startDate = \Carbon\Carbon::parse($task->StartDate);
                                                $dueDate = \Carbon\Carbon::parse($task->DueDate);
                                            @endphp

                                            @if ($now < $startDate)
                                                <span class="text-info">Chưa mở</span>
                                            @elseif ($now > $dueDate)
                                                <span class="text-danger">Quá hạn</span>
                                            @else
                                                @if ($task->DueDate)
                                                    <span class="countdown-timer"
                                                        data-due-date="{{ $task->DueDate->format('Y-m-d H:i:s') }}">
                                                    </span>
                                                @else
                                                    <span>Chưa giao</span>
                                                @endif
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="#!" class=" b-b-primary text-primary">Xem tất cả</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>Nhiệm vụ</h5>
                    
                </div>
                <div class="card-block">
                    <div class="latest-update-box">
                        @foreach ($subtasks->slice(0, 10) as $subtask)
                            <div class="row p-b-30">
                                <div class="col-auto text-right update-meta">
                                    {{-- <p class="text-muted m-b-0 d-inline">{{ \Carbon\Carbon::parse($subtask->DueDate)->diffForHumans() }}</p> --}}
                                    <p class="text-muted m-b-0 d-inline">
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $startDate = \Carbon\Carbon::parse($subtask->StartDate);
                                            $dueDate = \Carbon\Carbon::parse($subtask->DueDate);
                                        @endphp

                                        @if ($now < $startDate)
                                            <span class="text-info">Chưa mở</span>
                                        @elseif ($now > $dueDate)
                                            <span class="text-danger">Quá hạn</span>
                                        @else
                                            <span class="countdown-timer"
                                                data-due-date="{{ $subtask->DueDate->format('Y-m-d H:i:s') }}">
                                            </span>
                                        @endif
                                    </p>

                                    <i class="feather bg-info update-icon"><i class="fa fa-tasks"></i></i>
                                </div>
                                <div class="col">
                                    <h6>{{ $subtask->SubTaskName }}</h6>
                                    <p class="text-muted m-b-0">{{ $subtask->Description }}</p>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    <div class="text-center">
                        <a href="#!" class="b-b-primary text-primary">Xem tất cả nhiệm vụ</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ticket and update end -->

    </div>
@endsection

@section('scripts')
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\css-scrollbars.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="..\files\bower_components\chart.js\js\Chart.js"></script>
    <!-- Google map js -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="..\files\assets\pages\google-maps\gmaps.js"></script>
    <!-- gauge js -->
    <script src="..\files\assets\pages\widget\gauge\gauge.min.js"></script>
    <script src="..\files\assets\pages\widget\amchart\amcharts.js"></script>
    <script src="..\files\assets\pages\widget\amchart\serial.js"></script>
    <script src="..\files\assets\pages\widget\amchart\gauge.js"></script>
    <script src="..\files\assets\pages\widget\amchart\pie.js"></script>
    <script src="..\files\assets\pages\widget\amchart\light.js"></script>
    <!-- Custom js -->
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\files\assets\pages\dashboard\crm-dashboard.min.js"></script>
    <script type="text/javascript" src="..\files\assets\js\script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownElements = document.querySelectorAll('.countdown-timer');

            countdownElements.forEach((element) => {
                const dueDate = new Date(element.dataset.dueDate).getTime();

                const updateCountdown = () => {
                    const now = new Date().getTime();
                    const distance = dueDate - now;

                    if (distance < 0) {
                        element.innerHTML = '<span class="text-danger">Quá hạn</span>';
                        clearInterval(interval);
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    element.innerHTML = `
                ${days > 0 ? days + 'd ' : ''}
                ${hours > 0 ? hours + 'h ' : ''}
                ${minutes > 0 ? minutes + 'm ' : ''}
                ${seconds}s
            `;
                };

                const interval = setInterval(updateCountdown, 1000);
                updateCountdown();
            });
        });
    </script>
@endsection
