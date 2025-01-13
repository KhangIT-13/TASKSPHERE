@extends('layout.app')
@section('title', 'Chi tiết dự án')
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
                        <li class="breadcrumb-item"><a href="#!">Task</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Task-Detail</a>
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
                {{-- <div class="card">
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
                            @if($project->Status === 'Active')
                                <i class="icofont icofont-pause text-warning"></i>
                            @elseif($project->Status === 'OnHold')
                                <i class="icofont icofont-pause text-secondary"></i>
                            @elseif($project->Status === 'Resolved')
                                <i class="icofont icofont-check text-success"></i>
                            @elseif($project->Status === 'Closed')
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
                                    {{$project->Status}}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown2"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <a class="dropdown-item waves-light waves-effect @if($project->Status === 'Active') active @endif" href="#!">Active</a>
                                    <a class="dropdown-item waves-light waves-effect @if($project->Status === 'On hold') active @endif" href="#!">On hold</a>
                                    <a class="dropdown-item waves-light waves-effect @if($project->Status === 'Resolved') active @endif" href="#!">Resolved</a>
                                    <a class="dropdown-item waves-light waves-effect @if($project->Status === 'Closed') active @endif" href="#!">Closed</a>
                                    <div class="dropdown-divider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-ui-note m-r-10"></i>Chi tiết dự án</h5>
                    </div>
                    <div class="card-block task-details">
                        <table class="table table-border table-xs">
                            <tbody>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Dự án:</td>
                                    <td class="text-right"><span class="f-right"><a href="#">
                                                {{ $project->ProjectName }}</a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Bắt đầu:</td>
                                    <td class="text-right">{{ $project->StartDate->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Kết thúc:</td>
                                    <td class="text-right">{{ $project->EndDate->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Trạng thái:</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="#">
                                                {{ $project->Status }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Danh mục:</td>
                                    <td class="text-right">{{ $project->category->CategoryName }}</td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Người tạo:</td>
                                    <td class="text-right"><a href="#">{{ $project->creator->FullName }}</a></td>
                                </tr>
                                <tr>
                                    <td><i class="icofont icofont-listing-box"></i> Số thành viên:</td>
                                    <td class="text-right">{{ $project->members->count() }}</td>
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
                {{-- <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-wheel m-r-10"></i> Task Settings</h5>
                    </div>
                    <div class="card-block task-setting">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Publish after save</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Allow comments</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Allow users to edit the task</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Use task timer</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Auto saving</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Auto saving</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="f-left">Allow attachments</label>
                                    <input type="checkbox" class="js-small f-right" checked="">
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm-12">
                                    <button type="button"
                                        class="btn btn-default waves-effect p-l-40 p-r-40  m-r-30">Reset
                                    </button>
                                    <button type="button"
                                        class="btn btn-primary waves-effect waves-light p-l-40 p-r-40">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-certificate-alt-2 m-r-10"></i> Revisions
                        </h5>
                    </div>
                    <div class="card-block revision-block">
                        <div class="form-group">
                            <div class="row">
                                <ul class="media-list revision-blc">
                                    <li class="media d-flex m-b-15">
                                        <div class="p-l-15 p-r-20 d-inline-block v-middle"><a href="#"
                                                class="btn btn-outline-primary btn-lg txt-muted btn-icon"><i
                                                    class="icon-ghost f-18 v-middle"></i></a></div>
                                        <div class="d-inline-block">
                                            Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                            <div class="media-annotation">4 minutes ago</div>
                                        </div>
                                    </li>
                                    <li class="media d-flex m-b-15">
                                        <div class="p-l-15 p-r-20 d-inline-block v-middle"><a href="#"
                                                class="btn btn-outline-primary btn-lg txt-muted btn-icon"><i
                                                    class="icon-vector f-18 v-middle"></i></a></div>
                                        <div class="d-inline-block">
                                            Add full font overrides for popovers and tooltips
                                            <div class="media-annotation">36 minutes ago</div>
                                        </div>
                                    </li>
                                    <li class="media d-flex m-b-15">
                                        <div class="p-l-15 p-r-20 d-inline-block v-middle"><a href="#"
                                                class="btn btn-outline-primary btn-lg txt-muted btn-icon"><i
                                                    class="icon-share-alt f-18 v-middle"></i></a></div>
                                        <div class="d-inline-block">
                                            created a new Design branch
                                            <div class="media-annotation">36 minutes ago</div>
                                        </div>
                                    </li>
                                    <li class="media d-flex m-b-15">
                                        <div class="p-l-15 p-r-20 d-inline-block v-middle"><a href="#"
                                                class="btn btn-outline-primary btn-lg txt-muted btn-icon"><i
                                                    class="icon-equalizer f-18 v-middle"></i></a></div>
                                        <div class="d-inline-block">
                                            merged Master and Dev branches
                                            <div class="media-annotation">48 minutes ago</div>
                                        </div>
                                    </li>
                                    <li class="media d-flex">
                                        <div class="p-l-15 p-r-20 d-inline-block v-middle"><a href="#"
                                                class="btn btn-outline-primary btn-lg txt-muted btn-icon"><i
                                                    class="icon-graph f-18 v-middle"></i></a></div>
                                        <div class="d-inline-block">
                                            Have Carousel ignore keyboard events
                                            <div class="media-annotation">Dec 12, 05:46</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-attachment"></i> Tài liệu dự án</h5>
                    </div>
                    <div class="card-block task-attachment">
                        <ul class="media-list">
                            @foreach ($project->projectfiles as $projectfile)
                                <li class="media d-flex m-b-10">
                                    <div class="m-r-20 v-middle">
                                        <i class="icofont icofont-file-word f-28 text-muted"></i>
                                    </div>
                                    <div class="media-body">
                                        <a href="#" class="m-b-5 d-block">{{ $projectfile->filename }}</a>
                                        <div class="text-muted">
                                            {{-- <span>Size: 1.2Mb</span> --}}
                                            <span>
                                                Thêm bởi <a
                                                    href="">{{ $projectfile->with('user')->get()->find($projectfile->id)->user->FullName }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="f-right v-middle text-muted">
                                        <i class="icofont icofont-download-alt f-18"></i>
                                    </div>
                                </li>
                            @endforeach
                            {{-- <li class="media d-flex m-b-10">
                                <div class="m-r-20 v-middle">
                                    <i class="icofont icofont-file-powerpoint f-28 text-muted"></i>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="m-b-5 d-block">And_less_maternally.pdf</a>
                                    <div class="text-muted">
                                        <span>Size: 0.11Mb</span>
                                        <span>
                                            Added by <a href="">Eugene</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="f-right v-middle text-muted">
                                    <i class="icofont icofont-download-alt f-18"></i>
                                </div>
                            </li>
                            <li class="media d-flex m-b-10">
                                <div class="m-r-20 v-middle">
                                    <i class="icofont icofont-file-pdf f-28 text-muted"></i>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="m-b-5 d-block">The_less_overslept.pdf</a>
                                    <div class="text-muted">
                                        <span>Size:5.9Mb</span>
                                        <span>
                                            Added by <a href="">Natalie</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="f-right v-middle text-muted">
                                    <i class="icofont icofont-download-alt f-18"></i>
                                </div>
                            </li>
                            <li class="media d-flex m-b-10">
                                <div class="m-r-20 v-middle">
                                    <i class="icofont icofont-file-exe f-28 text-muted"></i>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="m-b-5 d-block">Well_equitably.mov</a>
                                    <div class="text-muted">
                                        <span>Size:20.9Mb</span>
                                        <span>
                                            Added by <a href="">Jenny</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="f-right v-middle text-muted">
                                    <i class="icofont icofont-download-alt f-18"></i>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text"><i class="icofont icofont-users-alt-4"></i> Thành viên</h5>
                    </div>
                    <div class="card-block user-box assign-user">
                        @foreach ($project->members as $member)
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="#">
                                        <img class="img-radius" src="{{ asset('files\assets\images\avatar-3.jpg') }}"
                                            alt="chat-user">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6>{{ $member->FullName }}</h6>
                                    <p>{{ $member->pivot->RoleInProject ? $member->pivot->RoleInProject : "-" }}</p>
                                </div>
                                <div>
                                    <a href="#!" class="text-muted"> <i class="icon-options-vertical"></i></a>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="#">
                                    <img class="img-radius" src="..\files\assets\images\avatar-2.jpg" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6>Larry heading </h6>
                                <p>Web Designer</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted"> <i class="icon-options-vertical"></i></a>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="#">
                                    <img class="img-radius" src="..\files\assets\images\avatar-1.jpg" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6>Mark</h6>
                                <p>Chief Financial Officer (CFO)</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted"> <i class="icon-options-vertical"></i></a>
                            </div>
                        </div>
                        <div class="media p-0 d-flex">
                            <div class="media-left media-middle photo-table">
                                <a href="#">
                                    <img class="img-radius" src="..\files\assets\images\avatar-4.jpg" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6>John Doe</h6>
                                <p>Senior Marketing Designer</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted"> <i class="icon-options-vertical"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Task-detail-right start -->
            <!-- Task-detail-left start -->
            <div class="col-xl-8 col-lg-12 pull-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="icofont icofont-tasks-alt m-r-5"></i> Chi tiết nội dung dự án</h5>
                        {{-- <button class="btn btn-sm btn-primary f-right"><i class="icofont icofont-ui-alarm"></i>Check
                            in</button> --}}
                    </div>
                    <div class="card-block">
                        <div class="">
                            {{-- <div class="m-b-20">
                                <h6 class="sub-title m-b-15">Overview</h6>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                            </div>
                            <div class="m-b-20">
                                <h6 class="sub-title m-b-15">What we need</h6>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                            </div> --}}
                            <div class="m-b-20 col-sm-12">
                                <div>
                                    {!! $project->Description !!}
                                    {{-- <div class="col-md-12 col-lg-6">
                                        <div class="text-primary f-14 m-b-10">
                                            1. The standard Lorem Ipsum passage
                                        </div>
                                        <div class="f-12">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text.
                                        </div>
                                        <div class="text-primary f-14 m-b-10 m-t-15">
                                            2. The standard Lorem Ipsum passage
                                        </div>
                                        <div class="f-12">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text.
                                        </div>
                                        <div class="text-primary f-14 m-b-10 m-t-15">
                                            3. The standard Lorem Ipsum passage
                                        </div>
                                        <div class="f-12">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text.
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="text-primary f-14 m-b-10">
                                            1. The standard Lorem Ipsum passage
                                        </div>
                                        <div class="f-12">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text.
                                        </div>
                                        <div class="text-primary f-14 m-b-10 m-t-15">
                                            2.The standard Lorem Ipsum passage
                                        </div>
                                        <div class="f-12">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text.
                                        </div>
                                        <div class="text-primary f-14 m-b-10 m-t-15">
                                            3. The standard Lorem Ipsum passage
                                        </div>
                                        <div class="f-12">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                            Ipsum has been the industry's standard dummy text.
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="m-b-20">
                                <h6 class="sub-title m-b-15">Các công việc của dự án</h6>
                                {{-- <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p> --}}
                                <div class="table-responsive m-t-20">
                                    <table class="table m-b-0 f-14 b-solid requid-table">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Công việc</th>
                                                <th class="text-center">Kết thúc</th>
                                                <th class="text-center">Độ ưu tiên</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center text-muted">
                                            @foreach ($project->tasks as $task)
                                                <tr>
                                                    <td><a href="">{{ $task->TaskId }}</a></td>
                                                    <td><a href="">{{ $task->TaskName }}</a></td>
                                                    <td>
                                                        <i class="icofont icofont-ui-calendar"></i>&nbsp;
                                                        {{$task->DueDate ? $task->DueDate->format('d-m-Y') : '' }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $statusClass = match ($task->Priority) {
                                                                'High' => 'label-primary', // Màu xanh dương
                                                                'Medium' => 'label-warning', // Màu xanh nhạt
                                                                'Low' => 'label-danger', // Màu đỏ
                                                            };
                                                        @endphp
                                                        <label
                                                            class="label {{ $statusClass }}">{{ ucfirst($task->Priority) }}</label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <td>2</td>
                                                <td>Software Engineer</td>
                                                <td> <i class="icofont icofont-ui-calendar"></i>&nbsp; 01 December, 16</td>
                                                <td>The standard Lorem Ipsum passage</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Photoshop And Illustrator</td>
                                                <td> <i class="icofont icofont-ui-calendar"></i>&nbsp; 15 December, 16</td>
                                                <td>The standard Lorem Ipsum passage</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Allocated Resource</td>
                                                <td> <i class="icofont icofont-ui-calendar"></i>&nbsp; 28 December, 16</td>
                                                <td>The standard Lorem Ipsum passage</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Financial Controlle</td>
                                                <td> <i class="icofont icofont-ui-calendar"></i>&nbsp; 20 December, 16</td>
                                                <td>The standard Lorem Ipsum passage</td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="m-t-20 m-b-20">
                                <h6 class="sub-title m-b-15">Uploaded files</h6>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="card thumb-block">
                                        <div class="thumb-img">
                                            <img src="..\files\assets\images\task\task-u1.jpg" class="img-fluid width-100"
                                                alt="task-u1.jpg">
                                            <div class="caption-hover">
                                                <span>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-ui-zoom-in"></i> </a>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-download-alt"></i> </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="#!"> task/task-u1.jpg </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card thumb-block">
                                        <div class="thumb-img">
                                            <img src="..\files\assets\images\task\task-u2.jpg" class="img-fluid width-100"
                                                alt="task-u2.jpg">
                                            <div class="caption-hover">
                                                <span>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-ui-zoom-in"></i> </a>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-download-alt"></i> </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="#!"> task/task-u2.jpg </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card thumb-block">
                                        <div class="thumb-img">
                                            <img src="..\files\assets\images\task\task-u3.jpg" class="img-fluid width-100"
                                                alt="task-u3.jpg">
                                            <div class="caption-hover">
                                                <span>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-ui-zoom-in"></i> </a>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-download-alt"></i> </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="#!"> task/task-u3.jpg </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card thumb-block">
                                        <div class="thumb-img">
                                            <img src="..\files\assets\images\task\task-u4.jpg" class="img-fluid width-100"
                                                alt="task-u4.jpg">
                                            <div class="caption-hover">
                                                <span>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-ui-zoom-in"></i> </a>
                                                    <a href="#" class="btn btn-primary btn-sm"><i
                                                            class="icofont icofont-download-alt"></i> </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="#!"> task/task-u4.jpg </a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <div class="f-left">
                            <span class=" txt-primary"> <i class="icofont icofont-chart-line-alt"></i>
                                Status:</span>
                            <div class="dropdown-secondary dropdown d-inline-block">
                                <button class="btn btn-sm btn-primary dropdown-toggle waves-light" type="button"
                                    id="dropdown4" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">Open</button>
                                <div class="dropdown-menu" aria-labelledby="dropdown4" data-dropdown-in="fadeIn"
                                    data-dropdown-out="fadeOut">
                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
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
                        </div>
                        <div class="f-right d-flex">
                            <span>
                                <a href="#!" class="text-muted m-r-10 f-16"><i class="icofont icofont-edit"></i>
                                </a>
                            </span>
                            <span class="m-r-10">
                                <a href="#!" class="text-muted f-16"><i class="icofont icofont-ui-delete"></i></a>
                            </span>
                            <div class="dropdown-secondary dropdown d-inline-block">
                                <button
                                    class="btn btn-sm btn-primary dropdown-toggle waves-light bg-white b-none txt-muted"
                                    type="button" id="dropdown5" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdown5" data-dropdown-in="fadeIn"
                                    data-dropdown-out="fadeOut">
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-ui-alarm m-r-10"></i>Check in</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-attachment m-r-10"></i>Attach screenshot</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-spinner-alt-5 m-r-10"></i>Reassign</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-ui-edit m-r-10"></i>Edit task</a>
                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                            class="icofont icofont-close-line m-r-10"></i>Remove</a>
                                </div>
                                <!-- end of dropdown menu -->
                            </div>
                        </div>
                    </div> --}}
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
            const status = @json($project->Status); 
            const startDate = new Date(@json($project->StartDate)).getTime();
            const endDate = new Date(@json($project->EndDate)).getTime();
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
