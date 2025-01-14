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
                        <a href="{{ route('subtask.addSubtask') }}"><button class="btn btn-grd-success">Thêm nhiệm vụ
                                mới</button></a>
                    </div>
                    <div class="card-header">
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
                                        <th>Hành động</th>
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
                                                <select name="status" class="form-control form-control-sm">
                                                    <option value="InProgress"
                                                        {{ $subtask->Status == 'InProgress' ? 'selected' : '' }}>InProgress
                                                    </option>
                                                    <option value="Pending"
                                                        {{ $subtask->Status == 'Pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="Blocked"
                                                        {{ $subtask->Status == 'Blocked' ? 'selected' : '' }}>Blocked
                                                    </option>
                                                    <option value="Completed"
                                                        {{ $subtask->Status == 'Completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="start_date" type="datetime-local" class="form-control"
                                                    value="{{ $subtask->StartDate ? $subtask->StartDate : '' }}" />
                                            </td>

                                            <td>
                                                <input name="end_date" type="datetime-local" class="form-control"
                                                    value="{{ $subtask->DueDate }}" />
                                            </td>
                                            <td>
                                                <input type="datetime-local" class="form-control"
                                                    value="{{ $subtask->CompletedAt ? $subtask->CompletedAt : '' }}" />
                                            </td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ Route('subtask.edit', ['SubtaskId' => $subtask->SubTaskId]) }}"
                                                        class="btn btn-primary btn-sm">Sửa</a>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteSubtask({{ $subtask->SubTaskId }})"
                                                        class="btn btn-danger btn-sm">Xóa</a>

                                                    <script>
                                                        function deleteSubtask(subtaskId) {
                                                            if (confirm('Bạn có chắc chắn muốn xóa nhiệm vụ này không?')) {
                                                                // Gửi yêu cầu DELETE tới route xóa dự án
                                                                fetch(`/subtask/${subtaskId}`, {
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
                                                    {{-- <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-attachment"></i> Đính kèm</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-ui-edit"></i> Chỉnh sửa</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-refresh"></i> Giao lại</a>
                                                    </div> --}}
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
            // Khi thay đổi trạng thái
            $('select[name="status"]').change(function() {
                const subtaskId = $(this).closest('tr').find('td:first').text().replace('#', '').trim();
                const status = $(this).val();

                $.ajax({
                    url: '{{ route('subtask.updateField') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        subtask_id: subtaskId,
                        status: status,
                    },
                    success: function(response) {
                        showAlert(response.message, 'success');
                    },
                    error: function(error) {
                        showAlert('Đã xảy ra lỗi khi cập nhật', 'error');
                    },
                });
            });

            // Khi thay đổi ngày bắt đầu hoặc ngày kết thúc
            $('input[name="start_date"], input[name="end_date"]').change(function() {
                const subtaskId = $(this).closest('tr').find('td:first').text().replace('#', '').trim();
                const startDate = $(this).closest('tr').find('input[name="start_date"]').val();
                const endDate = $(this).closest('tr').find('input[name="end_date"]').val();
                // alert(subtaskId);
                $.ajax({
                    url: '{{ route('subtask.updateField') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        subtask_id: subtaskId,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function(response) {
                        showAlert(response.message, 'success');
                    },
                    error: function(error) {
                        showAlert('Đã xảy ra lỗi khi cập nhật', 'error');
                    },
                });
            });
        });
    </script>
@endsection
