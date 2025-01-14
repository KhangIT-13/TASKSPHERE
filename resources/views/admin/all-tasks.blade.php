@extends('admin.layout')

@section('title', 'Danh sách công việc')
@section('css')
    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather.css') }}">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">

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
                        <a href="{{ route('tasks.addtask') }}"><button class="btn btn-grd-success">Thêm công việc
                                mới</button></a>
                    </div>
                    <div class="card-header">
                        <h5>Danh sách công việc của dự án </h5>
                    </div>
                    <div class="card-block task-list">
                        <div class="table-responsive">
                            <table id="simpletable"
                                class="table dt-responsive task-list-table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên công việc</th>
                                        <th>Dự án</th>
                                        <th>Độ ưu tiên</th>
                                        <th>Trạng thái</th>
                                        <th>Bắt đầu</th>
                                        <th>Kết thúc</th>
                                        <th>Hoàn thành</th>
                                        <th>Thành viên</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="task-page">
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>#{{ $task->TaskId }}</td>
                                            <td>
                                                {{ $task->TaskName }}
                                            </td>
                                            <td>{{ $task->project->ProjectName }}</td>
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
                                            <td>
                                                <select name="status" class="form-control form-control-sm ajax-update"
                                                    data-id="{{ $task->TaskId }}" data-field="Status">
                                                    <option value="InProgress"
                                                        {{ $task->Status == 'InProgress' ? 'selected' : '' }}>InProgress
                                                    </option>
                                                    <option value="Pending"
                                                        {{ $task->Status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Blocked"
                                                        {{ $task->Status == 'Blocked' ? 'selected' : '' }}>Blocked</option>
                                                    <option value="Completed"
                                                        {{ $task->Status == 'Completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="datetime-local" class="form-control ajax-update"
                                                    value="{{ $task->StartDate }}" data-id="{{ $task->TaskId }}"
                                                    data-field="StartDate">
                                            </td>
                                            <td>
                                                <input type="datetime-local" class="form-control ajax-update"
                                                    value="{{ $task->DueDate }}" data-id="{{ $task->TaskId }}"
                                                    data-field="DueDate">
                                            </td>

                                            <td>
                                                {{ $task->CompletedAt ? $task->CompletedAt->format('Y-m-d\TH:i') : 'Chưa hoàn thành' }}
                                                {{-- <input type="datetime-local" class="form-control"
                                                    value="{{ $task->CompletedAt ? $task->CompletedAt->format('Y-m-d\TH:i') : '' }}" /> --}}
                                            </td>
                                            <td>
                                                |
                                                @foreach ($task->taskassignments()->with('user')->get() as $taskassignment)
                                                    <a href="#">{{ $taskassignment->user->FullName }}</a> |
                                                @endforeach

                                                <a href="#"><i class="icofont icofont-plus f-w-600"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ Route('tasks.edit', ['TaskId' => $task->TaskId]) }}"
                                                        class="btn btn-primary btn-sm">Sửa</a>
                                                    {{-- <a href="{{ Route('tasks.delete',['id' => $task->TaskId])}}" class="btn btn-danger btn-sm">Xóa</a> --}}
                                                    <a href="javascript:void(0);" onclick="deleteTask({{ $task->TaskId }})"
                                                        class="btn btn-danger btn-sm">Xóa</a>

                                                    <script>
                                                        function deleteTask(taskId) {
                                                            if (confirm('Bạn có chắc chắn muốn xóa công việc này không?')) {
                                                                // Gửi yêu cầu DELETE tới route xóa dự án
                                                                fetch(`/tasks/${taskId}`, {
                                                                        method: 'DELETE',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                                        }
                                                                    })
                                                                    .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
                                                                    .then(data => {
                                                                        if (data.message) {
                                                                            showAlert(data.message, 'success'); // Hiển thị thông báo thành công
                                                                            location.reload(); // Hoặc chuyển hướng đến trang khác
                                                                        } else {
                                                                            showAlert('Xóa dự án thất bại', 'error');
                                                                        }
                                                                    })
                                                                    .catch(error => {
                                                                        showAlert('Có lỗi xảy ra khi xóa dự án', 'error');
                                                                        console.error(error);
                                                                    });
                                                            }
                                                        }
                                                    </script>
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('subtask.subtasksWithTask', ['TaskId' => $task->TaskId]) }}"><i
                                                                class="icofont icofont-attachment"></i> Quản lý nhiệm vụ</a>
                                                        {{-- <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-ui-edit"></i> Chỉnh sửa</a> --}}
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item"
                                                            href="{{ route('tasks.members', ['TaskId' => $task->TaskId]) }}"><i
                                                                class="icofont icofont-user"></i> Quản lý thành viên</a>
                                                    </div>
                                                </div>
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
                <!-- Task list card end -->
                <!-- To list card start -->
                {{-- <div class="card">
                    <div class="card-header">
                        <h5>To List</h5>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 btn-add-task">
                                <div class="input-group input-group-button">
                                    <input type="text" class="form-control" placeholder="Add Task" />
                                    <span class="input-group-addon btn btn-primary" id="basic-addon1">
                                        <i class="icofont icofont-plus f-w-600"></i>Add task
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="new-task">
                            <div class="to-do-list">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="" />
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>Primary</span>
                                    </label>
                                </div>
                            </div>
                            <div class="to-do-list">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="" />
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>Primary</span>
                                    </label>
                                </div>
                            </div>
                            <div class="to-do-list">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="" />
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>Primary</span>
                                    </label>
                                </div>
                            </div>
                            <div class="to-do-list">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="" />
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>Primary</span>
                                    </label>
                                </div>
                            </div>
                            <div class="to-do-list">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="" />
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>Primary</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- To list card end -->
            </div>
        </div>
        <!-- Page-body end -->
    </div>
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
    <!-- data-table js -->
    <script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}">
    </script>
    <!-- Custom js -->
    <script src="{{ asset('files/assets/pages/data-table/js/data-table-custom.js') }}"></script>

    <script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/vartical-layout.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.ajax-update').on('change', function() {
                let taskId = $(this).data('id');
                let field = $(this).data('field');
                let value = $(this).val();

                $.ajax({
                    url: '{{ route('tasks.updateField') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        TaskId: taskId,
                        field: field,
                        value: value,
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert('Có lỗi xảy ra!');
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                alert(value[0]);
                            });
                        } else {
                            alert('Có lỗi xảy ra!');
                        }
                    }
                });
            });
        });
    </script>
@endsection
