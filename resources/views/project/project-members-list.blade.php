@extends('layout.app')
@section('title', 'Danh sách thành viên')
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
    <style>
        /* Overlay cho confirm box */
        .custom-confirm-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        /* Hộp thoại confirm */
        .custom-confirm-box {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        /* Tiêu đề và nội dung */
        .custom-confirm-box h4 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .custom-confirm-box p {
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }

        /* Nút xác nhận và hủy */
        .custom-confirm-buttons {
            display: flex;
            justify-content: space-around;
        }

        .custom-confirm-buttons button {
            min-width: 100px;
        }
    </style>
@endsection
@section('content')
    <!-- Custom Confirm Box -->
    <div id="custom-confirm" class="custom-confirm-overlay" style="display: none;">
        <div class="custom-confirm-box">
            <h4>Xác nhận hành động</h4>
            <p>Bạn có chắc chắn muốn xóa thành viên này không?</p>
            <div class="custom-confirm-buttons">
                <button id="confirm-yes" class="btn btn-danger">Xóa</button>
                <button id="confirm-no" class="btn btn-secondary">Hủy</button>
            </div>
        </div>
    </div>

    <!-- Page-header start -->
    <div class="page-header">
        <div class="col-12">
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
        <div class="row align-items-end col-12">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Danh sách thành viên</h4>
                        <span>Dự án : {{ $project->ProjectName }}</span>
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <!-- Page-body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12 row">
                <div class="col-3"></div>
                <!-- Task list card start -->
                <div class="card col-6">
                    <div class="card-header">
                        <a href="{{ route('project.project-add-member',['ProjectId' => $project->ProjectId]) }}"><button class="btn btn-grd-success">Thêm thành viên mới</button></a>
                    </div>
                    <div class="card-block task-list">
                        <div class="table-responsive">
                            <table id="simpletable"
                                class="table dt-responsive task-list-table table-striped table-bordered nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thành viên</th>
                                        <th>Vai trò</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="task-page col-12">
                                    @foreach ($members as $member)
                                        <tr>
                                            <td>#{{ $member->UserId }}</td>
                                            <td>
                                                <a href="{{ route('project.detail', ['id' => $member->UserId]) }}">
                                                    {{ $member->FullName }}</a>
                                            </td>
                                            <td>
                                                <select name="role" class="form-control form-control-sm"
                                                    data-project-id="{{ $project->ProjectId }}">
                                                    <option value="Manager"
                                                        {{ $member->pivot->RoleInProject == 'Manager' ? 'selected' : '' }}>
                                                        Manager</option>
                                                    <option value="Contributor"
                                                        {{ $member->pivot->RoleInProject == 'Contributor' ? 'selected' : '' }}>
                                                        Contributor</option>
                                                    <option value="Observer"
                                                        {{ $member->pivot->RoleInProject == 'Observer' ? 'selected' : '' }}>
                                                        Observer</option>
                                                </select>
                                            </td>



                                            <td class="text-center">
                                                <div class="btn-group">

                                                    <button class="btn-delete-member btn btn-danger btn-sm"
                                                        data-member-id="{{ $member->UserId }}"
                                                        data-project-id="{{ $project->ProjectId }}">
                                                        🗑️ Xóa
                                                    </button>



                                                    {{-- <script>
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
                                                    </script> --}}


                                                    <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-attachment"></i> Đính kèm</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-ui-edit"></i> Chỉnh sửa</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="icofont icofont-refresh"></i> Giao lại</a>
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
                <div class="col-3"></div>
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


    <script type="text/javascript">
        $(document).ready(function() {
            // Lắng nghe sự kiện thay đổi vai trò
            $('select[name="role"]').on('change', function() {
                var userId = $(this).closest('tr').find('td:first').text().replace('#', '')
                    .trim(); // Lấy UserId từ ô đầu tiên
                var projectId = $(this).data('project-id'); // Lấy ProjectId từ thuộc tính data nếu có
                var role = $(this).val(); // Lấy giá trị vai trò mới

                // Gửi AJAX để cập nhật vai trò
                $.ajax({
                    url: '{{ route('project.member.updateRole') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        project_id: projectId,
                        role: role
                    },
                    success: function(response) {
                        showAlert(response.message || 'Cập nhật vai trò thành công!',
                            'success');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        showAlert('Đã xảy ra lỗi khi cập nhật vai trò.', 'error');
                    }
                });
            });
            $('.btn-delete-member').on('click', function() {
                var memberId = $(this).data('member-id');
                var projectId = $(this).data('project-id');

                // Sử dụng Custom Confirm
                customConfirm('Bạn có chắc chắn muốn xóa thành viên này không?', function(confirmed) {
                    if (confirmed) {
                        $.ajax({
                            url: '{{ route('project.projectmembers.delete') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                member_id: memberId,
                                project_id: projectId
                            },
                            success: function(response) {
                                showAlert('Xóa thành viên thành công!', 'success');
                                $(`button[data-member-id="${memberId}"][data-project-id="${projectId}"]`)
                                    .closest('tr')
                                    .remove();
                            },
                            error: function() {
                                showAlert('Đã xảy ra lỗi khi xóa thành viên.', 'error');
                            }
                        });
                    } else {
                        showAlert('Hủy xóa thành viên.', 'info');
                    }
                });
            });

            // Custom Confirm Function
            function customConfirm(message, callback) {
                $('#custom-confirm p').text(message);
                $('#custom-confirm').fadeIn(200);

                // Xác nhận hành động
                $('#confirm-yes').off('click').on('click', function() {
                    $('#custom-confirm').fadeOut(200);
                    callback(true); // Gọi lại hàm với true khi xác nhận
                });

                // Hủy bỏ hành động
                $('#confirm-no').off('click').on('click', function() {
                    $('#custom-confirm').fadeOut(200);
                    callback(false); // Gọi lại hàm với false khi hủy
                });
            }

        });
    </script>
@endsection
