@extends('layout.app')
@section('title', 'Thêm thành viên ')
@section('css')
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">

    <!-- Icon Libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}">

    <!-- Multi Select CSS -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css') }}">

    <!-- Custom Scrollbar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">

    <style>
        /* Tùy chỉnh giao diện */
        #editor-container {
            height: 300px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .editor-toolbar {
            margin-bottom: 10px;
        }

        .save-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .save-button:hover {
            background-color: #45a049;
        }
    </style>
    <style>
        /* ========== Quill Editor CSS ========== */

        /* Tổng quan trình soạn thảo */
        #editor-container {
            height: 400px;
            /* Chiều cao cố định */
            border: 1px solid #e0e0e0;
            /* Viền nhẹ */
            border-radius: 8px;
            /* Bo góc mềm mại */
            padding: 10px;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        /* Thanh công cụ */
        .toolbar-container {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 5px;
            margin-bottom: 10px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
        }

        .toolbar-container .ql-formats {
            margin-right: 8px;
        }

        /* Các nút trong toolbar */
        .toolbar-container button,
        .toolbar-container select {
            border-radius: 4px;
            margin: 2px;
            transition: all 0.2s ease-in-out;
        }

        .toolbar-container button:hover,
        .toolbar-container select:hover {
            background-color: #e9ecef;
        }

        /* Nút lưu */
        .save-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .save-button:hover {
            background-color: #388E3C;
        }

        /* Khu vực hiển thị nội dung */
        .content-output {
            margin-top: 30px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            background-color: #fafafa;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
        }

        /* Hình ảnh bên trong Quill */
        .ql-editor img {
            max-width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .ql-editor img:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Ảnh có thể thay đổi kích thước */
        .resizable-img {
            resize: both;
            overflow: auto;
            border: 1px dashed #ccc;
            padding: 5px;
        }

        /* Placeholder */
        .ql-editor.ql-blank::before {
            color: #999;
            font-style: italic;
        }

        /* Cuộn mượt */
        .ql-container {
            border-radius: 8px;
        }

        /* Tiêu đề */
        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 20px;
        }

        /* Nút nhập file */
        #file-input {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
            cursor: pointer;
        }

        #load-file {
            margin-left: 10px;
        }
    </style>
@endsection
@section('content')
    <!-- Page body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Basic Inputs Validation start -->
                <div class="card container-fluid">
                    <div class="card-header">
                        <h1 class="text-center">Thêm thành viên cho dự án</h1>
                        <span class="text-center mb-5">Lưu ý: <code>Nếu một người dùng được chọn ở nhiều vị trí </code> sẽ lấy <code>&lt;VỊ TRÍ CAO NHẤT&gt;</code></span>

                    </div>
                    <div class="card-block">
                        <form id="main" method="POST" action="{{ route('tasks.createMember') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Công việc</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" name="TaskId" id="name" value="{{$task->TaskId}}">
                                    <input type="text" class="form-control" name="TaskName" id="name" value="{{$task->TaskName}}" disabled>
                                    <span class="messages"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Người quản lý</label>
                                <div class="col-sm-10">
                                    <select name="membersOwner[] " class="form-control js-example-basic-multiple"
                                        multiple>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->UserId }}">{{ $member->FullName }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thành viên</label>
                                <div class="col-sm-10">
                                    <select name="membersCollaborator[] " class="form-control js-example-basic-multiple"
                                        multiple>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->UserId }}">{{ $member->FullName }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Người đánh giá</label>
                                <div class="col-sm-10">
                                    <select name="membersReviewer[] " class="form-control js-example-basic-multiple"
                                        multiple>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->UserId }}">{{ $member->FullName }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Basic Inputs Validation end -->

            </div>
        </div>
    </div>
    <!-- Page body end -->
@endsection
@section('scripts')
    <!-- Required jQuery -->
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- jQuery Slimscroll -->
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}">
    </script>

    <!-- Modernizr -->
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

    <!-- i18next -->
    <script type="text/javascript" src="{{ asset('files/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}">
    </script>

    <!-- Select2 -->
    <script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>

    <!-- MultiSelect -->
    <script type="text/javascript"
        src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('files/assets/js/jquery.quicksearch.js') }}"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>
    <script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/vartical-layout.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/pages/form-validation/validate.js') }}"></script>

    <!-- External Libraries (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    
@endsection
