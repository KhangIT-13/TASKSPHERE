@extends('layout.app')
@section('title', 'Danh sách dự án')
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
                        <h4>Danh sách dự án</h4>
                        <span>lorem ipsum dolor sit amet, consectetur
                            adipisicing elit</span>
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
                        <a href="{{route('project.add')}}"><button class="btn btn-grd-success">Thêm dự án mới</button></a>
                    </div>
                    <div class="card-block task-list">
                        <div class="table-responsive">
                            <table id="simpletable"
                                class="table dt-responsive task-list-table table-striped table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên dự án</th>
                                        <th>Người tạo</th>
                                        <th>Danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Bắt đầu (m-d-Y)</th>
                                        <th>Kết thúc (m-d-Y)</th>
                                        <th>Thành viên</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="task-page col-12">
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>#{{ $project->ProjectId }}</td>
                                            <td>
                                               <a href="{{route('project.detail', ['id'=> $project->ProjectId])}}"> {{ $project->ProjectName }}</a>
                                            </td>
                                            <td>
                                                {{ $project->creator->FullName }}
                                            </td>
                                            <td>{{ $project->category->CategoryName }}</td>

                                            <td>
                                                <select name="status" class="form-control form-control-sm">
                                                    <option value="Planned"
                                                        {{ $project->Status == 'Planned' ? 'selected' : '' }}>Planned
                                                    </option>
                                                    <option value="Active"
                                                        {{ $project->Status == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="OnHold"
                                                        {{ $project->Status == 'OnHold' ? 'selected' : '' }}>On Hold
                                                    </option>
                                                    <option value="Completed"
                                                        {{ $project->Status == 'Completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                    <option value="Archived"
                                                        {{ $project->Status == 'Archived' ? 'selected' : '' }}>Archived
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="datetime-local" class="form-control"
                                                    value="{{ $project->StartDate ? $project->StartDate->format('Y-m-d\TH:i') : '' }}"
                                                    name="start_date" />
                                            </td>

                                            <td>
                                                <input type="datetime-local" class="form-control"
                                                    value="{{ $project->EndDate ? $project->EndDate->format('Y-m-d\TH:i') : '' }}"
                                                    name="end_date" />
                                            </td>

                                            <td>
                                                {{ $project->members->count() > 0 ? '| ' : '' }}
                                                @forelse ($project->members as $member)
                                                    <a href="">{{ $member->FullName }} |</a>
                                                @empty
                                                    <span>Chưa có thành viên</span>
                                                @endforelse

                                                <a
                                                    href="{{ route('project.project-add-member', ['ProjectId' => $project->ProjectId]) }}"><i
                                                        class="icofont icofont-plus f-w-600"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('project.edit', ['id' => $project->ProjectId]) }}"
                                                        class="btn btn-primary btn-sm">Sửa</a>

                                                    <a href="javascript:void(0);"
                                                        onclick="deleteProject({{ $project->ProjectId }})"
                                                        class="btn btn-danger btn-sm">Xóa</a>

                                                    <script>
                                                        function deleteProject(projectId) {
                                                            if (confirm('Bạn có chắc chắn muốn xóa dự án này không?')) {
                                                                // Gửi yêu cầu DELETE tới route xóa dự án
                                                                fetch(`/project/${projectId}`, {
                                                                        method: 'DELETE',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                                        }
                                                                    })
                                                                    .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
                                                                    .then(data => {
                                                                        if (data.message) {
                                                                            alert(data.message); // Hiển thị thông báo thành công
                                                                            location.reload(); // Hoặc chuyển hướng đến trang khác
                                                                        } else {
                                                                            alert('Xóa dự án thất bại');
                                                                        }
                                                                    })
                                                                    .catch(error => {
                                                                        alert('Có lỗi xảy ra khi xóa dự án');
                                                                        console.error(error);
                                                                    });
                                                            }
                                                        }
                                                    </script>


                                                    <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('tasks.tasksWithProject',['ProjectId' => $project->ProjectId]) }}"><i
                                                                class="icofont icofont-attachment"></i> Quản lý công việc</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-ui-edit"></i> Chỉnh sửa</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{route('project.list_member', ['ProjectId' => $project->ProjectId])}}"><i
                                                                class="icofont icofont-refresh"></i> Quản lý thành viên</a>
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

    <script type="text/javascript">
        $(document).ready(function() {
            // Lắng nghe sự kiện thay đổi trạng thái
            $('select[name="status"]').on('change', function() {
                var projectId = $(this).closest('tr').find('td:first').text().replace('#', '')
                    .trim(); // Lấy ProjectId từ ô đầu tiên của hàng
                var status = $(this).val(); // Lấy giá trị trạng thái mới

                // Gửi AJAX để cập nhật trạng thái
                $.ajax({
                    url: '{{ route('projects.updateStatus') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        project_id: projectId,
                        status: status
                    },
                    success: function(response) {
                        showAlert('Cập nhật trạng thái thành công!','success');
                    },
                    error: function() {
                        showAlert('Đã xảy ra lỗi khi cập nhật trạng thái.','error');
                    }
                });
            });

            // Lắng nghe sự kiện thay đổi ngày bắt đầu
            $('input[name="start_date"]').on('change', function() {
                var projectId = $(this).closest('tr').find('td:first').text().replace('#', '')
                    .trim(); // Lấy ProjectId từ ô đầu tiên của hàng
                var startDate = $(this).val(); // Lấy giá trị ngày bắt đầu mới

                // Gửi AJAX để cập nhật ngày bắt đầu
                $.ajax({
                    url: '{{ route('projects.updateStartDate') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        project_id: projectId,
                        start_date: startDate
                    },
                    success: function(response) {
                        showAlert('Cập nhật ngày bắt đầu thành công!','success');
                    },
                    error: function() {
                        showAlert('Đã xảy ra lỗi khi cập nhật ngày bắt đầu.','error');
                    }
                });
            });

            // Lắng nghe sự kiện thay đổi ngày kết thúc
            $('input[name="end_date"]').on('change', function() {
                var projectId = $(this).closest('tr').find('td:first').text().replace('#', '')
                    .trim(); // Lấy ProjectId từ ô đầu tiên của hàng
                var endDate = $(this).val(); // Lấy giá trị ngày kết thúc mới

                // Gửi AJAX để cập nhật ngày kết thúc
                $.ajax({
                    url: '{{ route('projects.updateEndDate') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        project_id: projectId,
                        end_date: endDate
                    },
                    success: function(response) {
                        showAlert('Cập nhật ngày kết thúc thành công!','success');
                    },
                    error: function() {
                        showAlert('Đã xảy ra lỗi khi cập nhật ngày kết thúc.','error');
                    }
                });
            });
        });
    </script>
@endsection
