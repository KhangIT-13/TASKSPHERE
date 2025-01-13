@extends('layout.app')
@section('title', 'Dự án')
@section('css')
    <!-- Favicon icon -->

    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
    <style>
        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Các dự án của bạn</h4>
                        <span>Dưới đây là danh sách các dự án của bạn</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Project</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Project Board</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page body start -->
    <div class="page-body">
        <div class="row">

            <!-- Left column start -->
            <div class="col-xl-12 col-lg-12 filter-bar">
                <!-- Nav Filter tab start -->
                <!-- <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#!">Filter: <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="bydate" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-clock-time"></i> By
                                Date</a>
                            <div class="dropdown-menu" aria-labelledby="bydate">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Today</a>
                                <a class="dropdown-item" href="#!">Yesterday</a>
                                <a class="dropdown-item" href="#!">This week</a>
                                <a class="dropdown-item" href="#!">This month</a>
                                <a class="dropdown-item" href="#!">This year</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="bystatus" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i
                                    class="icofont icofont-chart-histogram-alt"></i> By Status</a>
                            <div class="dropdown-menu" aria-labelledby="bystatus">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Open</a>
                                <a class="dropdown-item" href="#!">On hold</a>
                                <a class="dropdown-item" href="#!">Resolved</a>
                                <a class="dropdown-item" href="#!">Closed</a>
                                <a class="dropdown-item" href="#!">Dublicate</a>
                                <a class="dropdown-item" href="#!">Wontfix</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="bypriority" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-sub-listing"></i> By
                                Priority</a>
                            <div class="dropdown-menu" aria-labelledby="bypriority">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Highest</a>
                                <a class="dropdown-item" href="#!">High</a>
                                <a class="dropdown-item" href="#!">Normal</a>
                                <a class="dropdown-item" href="#!">Low</a>
                            </div>
                        </li>
                    </ul>
                    {{-- <div class="nav-item nav-grid">
                        <span class="m-r-15">View Mode: </span>
                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-r-10"
                            data-toggle="tooltip" data-placement="top" title="list view">
                            <i class="icofont icofont-listine-dots"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                            data-toggle="tooltip" data-placement="top" title="grid view">
                            <i class="icofont icofont-table"></i>
                        </button>
                    </div> --}}

                </nav> -->
                <!-- Nav Filter tab end -->
                <!-- Task board design block start-->
                <div class="row">
                    @foreach ($projects as $project)
                        <div class="col-sm-4">
                            <div class="card card-border-default w-100">
                                <div class="card-header">
                                    <a href="{{ route('project.detail', ['id' => $project->ProjectId]) }}"
                                        class="card-title">#{{ $project->ProjectId }}.
                                        {{ $project->ProjectName }} </a>
                                    <span class="label label-success f-right">{{ $project->StartDate->format('d-m-Y') }} -
                                        {{ $project->EndDate->format('d-m-Y') }}</span>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{-- <p class="task-detail truncate">{!! $project->Description !!}</p> --}}
                                            {{-- <p class="task-due"><strong class="label label-success">Dự án chưa bắt đầu</strong></p> --}}
                                            <p class="task-due"><strong> Thời hạn : </strong>
                                                @php
                                                    $now = \Carbon\Carbon::now();
                                                    $startDate = \Carbon\Carbon::parse($project->StartDate);
                                                    $dueDate = \Carbon\Carbon::parse($project->EndDate);
                                                @endphp

                                                @if ($now < $startDate)
                                                    <strong class="label label-success">Chưa bắt đầu {{$now}}</strong>
                                                @elseif ($now > $dueDate)
                                                    <strong class="label label-danger">Đã kết thúc</strong>
                                                @else
                                                    <span class="countdown-timer"
                                                        data-due-date="{{ $project->EndDate->format('Y-m-d H:i:s') }}">
                                                    </span>
                                                @endif
                                                {{-- <strong class="label label-danger">23
                                                    hours</strong></p> --}}
                                        </div>
                                        <!-- end of col-sm-8 -->
                                    </div>
                                    <!-- end of row -->
                                </div>
                                <div class="card-footer d-flex align-center col-12">
                                    <div class="task-list-table truncate col-8 text-truncate">
                                        {{ $project->members->count() > 0 ? '| ' : '' }}
                                        @forelse ($project->members as $member)
                                            <a href="">{{ $member->FullName }} |</a>
                                        @empty
                                            <span>Chưa có thành viên</span>
                                        @endforelse
                                    </div>
                                    <div class="task-board col-4 m-0 p-0 d-flex justify-content-end">
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
                                        {{-- <div class="dropdown-secondary dropdown">
                                            <button
                                                class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                                type="button" id="dropdown1" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">Normal</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown1"
                                                data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                        class="point-marker bg-danger"></span>Highest priority</a>
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                        class="point-marker bg-warning"></span>High priority</a>
                                                <a class="dropdown-item waves-light waves-effect active"
                                                    href="#!"><span class="point-marker bg-success"></span>Normal
                                                    priority</a>
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                        class="point-marker bg-info"></span>Low priority</a>
                                            </div>
                                            <!-- end of dropdown menu -->
                                        </div>
                                        <div class="dropdown-secondary dropdown">
                                            <button
                                                class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                type="button" id="dropdown2" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">Open</button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown2"
                                                data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item waves-light waves-effect active"
                                                    href="#!">Open</a>
                                                <a class="dropdown-item waves-light waves-effect" href="#!">On
                                                    hold</a>
                                                <a class="dropdown-item waves-light waves-effect"
                                                    href="#!">Resolved</a>
                                                <a class="dropdown-item waves-light waves-effect"
                                                    href="#!">Closed</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect"
                                                    href="#!">Dublicate</a>
                                                <a class="dropdown-item waves-light waves-effect"
                                                    href="#!">Invalid</a>
                                                <a class="dropdown-item waves-light waves-effect"
                                                    href="#!">Wontfix</a>
                                            </div>
                                            <!-- end of dropdown menu -->
                                        </div>
                                        <!-- end of dropdown-secondary -->
                                        <div class="dropdown-secondary dropdown">
                                            <button
                                                class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                type="button" id="dropdown3" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"><i
                                                    class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown3"
                                                data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                        class="icofont icofont-ui-alarm"></i> Check in</a>
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                        class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                        class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                        class="icofont icofont-ui-edit"></i> Edit task</a>
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                        class="icofont icofont-close-line"></i> Remove</a>
                                            </div>
                                            <!-- end of dropdown menu -->
                                        </div> --}}
                                        <!-- end of seconadary -->
                                    </div>
                                    <!-- end of pull-right class -->
                                </div>
                                <!-- end of card-footer -->
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-sm-6">
                        <div class="card card-border-primary">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown4" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown4" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active" href="#!"><span
                                                    class="point-marker bg-success"></span>Normal priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown5" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown5" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-border-success">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown7" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown7" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active" href="#!"><span
                                                    class="point-marker bg-success"></span>Normal priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown8" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown8" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown9" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown9" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-border-info">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown10" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown10" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active" href="#!"><span
                                                    class="point-marker bg-success"></span>Normal priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown11" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown11" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown12" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-border-warning">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown13" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown13" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active" href="#!"><span
                                                    class="point-marker bg-success"></span>Normal priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown15" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown15" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-border-danger">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown16" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown16" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active" href="#!"><span
                                                    class="point-marker bg-success"></span>Normal priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown17" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown17" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown18" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown18" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-border-inverse">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown19" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown19" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active" href="#!"><span
                                                    class="point-marker bg-success"></span>Normal priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown20" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown20" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown21" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown21" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-border-success">
                            <div class="card-header">
                                <a href="#" class="card-title">#24. Create UI design model </a>
                                <span class="label label-default f-right"> 28 January, 2015 </span>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="task-detail">A collection of textile samples lay spread out on the table
                                            One morning, when Gregor Samsa woke from troubled.</p>
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23
                                                hours</strong></p>
                                    </div>
                                    <!-- end of col-sm-8 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <div class="card-footer">
                                <div class="task-list-table">
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                    <a href="#!"><img class="img-fluid img-radius"
                                            src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                    <a href="#!"><i class="icofont icofont-plus"></i></a>
                                </div>
                                <div class="task-board">
                                    <div class="dropdown-secondary dropdown">
                                        <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light"
                                            type="button" id="dropdown22" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Normal</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown22" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-danger"></span>Highest priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-warning"></span>High priority</a>
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!"><span class="point-marker bg-success"></span>Normal
                                                priority</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><span
                                                    class="point-marker bg-info"></span>Low priority</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown23" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">Open</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown23"
                                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect active"
                                                href="#!">Open</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                            <a class="dropdown-item waves-light waves-effect"
                                                href="#!">Resolved</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect"
                                                href="#!">Dublicate</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of dropdown-secondary -->
                                    <div class="dropdown-secondary dropdown">
                                        <button
                                            class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                            type="button" id="dropdown24" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><i
                                                class="icofont icofont-navigation-menu"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdown24"
                                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-alarm"></i> Check in</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-attachment"></i> Attach screenshot</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-ui-edit"></i> Edit task</a>
                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                    class="icofont icofont-close-line"></i> Remove</a>
                                        </div>
                                        <!-- end of dropdown menu -->
                                    </div>
                                    <!-- end of seconadary -->
                                </div>
                                <!-- end of pull-right class -->
                            </div>
                            <!-- end of card-footer -->
                        </div>
                    </div> --}}
                </div>
                <!-- Task board design block end -->
            </div>
            <!-- Left column end -->
        </div>
    </div>
    <!-- Page body end -->
@endsection
@section('scripts')
    <script type="text/javascript" src="..\files\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="..\files\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="..\files\bower_components\modernizr\js\css-scrollbars.js"></script>

    <!-- task board js -->
    <script type="text/javascript" src="..\files\assets\pages\task-board\task-board.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="..\files\bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="..\files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="..\files\assets\js\script.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
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
                    const months = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
                    const days = Math.floor((distance % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 *
                        24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    element.innerHTML = `
                    ${months > 0 ? months + ' tháng ' : ''}
                    ${days > 0 ? days + ' ngày ' : ''}
                    ${hours > 0 ? hours + ' giờ ' : ''}
                    ${minutes > 0 ? minutes + ' phút ' : ''}
                    `;
                };

                const interval = setInterval(updateCountdown, 1000);
                updateCountdown();
            });
        });
    </script>
@endsection
