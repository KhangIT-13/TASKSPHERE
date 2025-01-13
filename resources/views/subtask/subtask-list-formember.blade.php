@extends('layout.app')
@section('title', 'Danh sách công việc')
@section('css')
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
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="..\files\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="..\files\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\jquery.mCustomScrollbar.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Danh sách công việc</h4>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-1.htm">
                                <i class="feather icon-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#!">Task</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#!">Task list</a>
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
            <div class="col-sm-12">
                <!-- Task list card start -->
                <div class="card">
                    <div class="card-header">
                        {{-- <h5>Danh sách nhiệm vụ của công việc {{ $subtasks->first()->task->TaskName }}</h5> --}}
                    </div>
                    <div class="card-block task-list">
                        <div class="table-responsive">
                            <table id="simpletable"
                                class="table dt-responsive task-list-table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên nhiệm vụ</th>
                                        <th>Dự án</th>
                                        <th>Công việc</th>
                                        <th>Độ ưu tiên</th>
                                        <th>Trạng thái</th>
                                        <th>Bắt đầu</th>
                                        <th>Kết thúc</th>
                                        <th>Hoàn thành</th>
                                        {{-- <th>Người phụ trách</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="task-page">
                                    @foreach ($subtasks as $subtask)
                                        <tr>
                                            <td>#{{ $subtask->SubTaskId }}</td>
                                            <td>
                                                {{ $subtask->SubTaskName }}
                                            </td>
                                            <td>
                                                {{ $subtask->task->project->ProjectName }}
                                            </td>
                                            <td>
                                                {{ $subtask->task->TaskName }}
                                            </td>

                                            <td>
                                                @php
                                                    $statusClass = match ($subtask->Priority) {
                                                        'High' => 'label-primary', // Màu xanh dương
                                                        'Medium' => 'label-warning', // Màu xanh nhạt
                                                        'Low' => 'label-danger', // Màu đỏ
                                                    };
                                                @endphp
                                                <label
                                                    class="label {{ $statusClass }}">{{ ucfirst($subtask->Priority) }}</label>
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = match ($subtask->Status) {
                                                        'InProgress' => 'label-primary', // Màu xanh dương
                                                        'Pending' => 'label-warning', // Màu vàng
                                                        'Blocked' => 'label-danger', // Màu đỏ
                                                        'Completed' => 'label-success', // Màu xanh lá
                                                        default => 'label-default', // Mặc định
                                                    };
                                                @endphp
                                                <label class="label {{ $statusClass }}">
                                                    {{ ucfirst($subtask->Status) }}
                                                </label>
                                            </td>

                                            <td>
                                                {{ $subtask->StartDate ? $subtask->StartDate : 'Chưa được chọn' }}
                                            </td>

                                            <td>
                                                {{ $subtask->DueDate ? $subtask->DueDate : 'Chưa được chọn' }}
                                            </td>
                                            <td>
                                                @if (is_null($subtask->CompletedAt))
                                                    <button class="btn btn-success btn-sm complete-task-btn"
                                                        data-id="{{ $subtask->SubTaskId }}">
                                                        Hoàn thành
                                                    </button>
                                                @else
                                                    <label class="label label-success">Đã hoàn thành</label>
                                                @endif
                                            </td>



                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Zero config.table card end -->
                    <!-- Default ordering table card start -->
                    <!-- Default ordering table card end -->
                </div>

            </div>
        </div>
        <!-- Page-body end -->
    </div>
@endsection

@section('scripts')
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
    <!-- data-table js -->
    <script src="..\files\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="..\files\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="..\files\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="..\files\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="..\files\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="..\files\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="..\files\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>
    <script src="..\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="..\files\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="..\files\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="..\files\bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript"
        src="..\files\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="..\files\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script src="..\files\assets\pages\data-table\js\data-table-custom.js"></script>

    <script src="..\files\assets\js\pcoded.min.js"></script>
    <script src="..\files\assets\js\vartical-layout.min.js"></script>
    <script src="..\files\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="..\files\assets\js\script.js"></script>
    <script>
        $(document).ready(function() {
            $('.complete-task-btn').click(function() {
                const subtaskId = $(this).data('id');
                const button = $(this);

                $.ajax({
                    url: '{{ route('subtask.complete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        subtask_id: subtaskId,
                    },
                    success: function(response) {
                        showAlert(response.message, 'success');

                        // Cập nhật giao diện sau khi hoàn thành
                        button.closest('td').html(
                            '<label class="label label-success">Đã hoàn thành</label>'
                        );
                        const statusTd = button.closest('tr').find('td').eq(5);
                        statusTd.html('<label class="label label-success">Completed</label>');
                    },
                    error: function() {
                        showAlert('Có lỗi xảy ra, vui lòng thử lại.', 'error');
                    },
                });
            });
        });
    </script>
@endsection
