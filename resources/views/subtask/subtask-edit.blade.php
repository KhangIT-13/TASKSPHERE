@extends('layout.app')
@section('title', 'Thêm mới công việc phụ')
@section('css')
    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- Themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- Ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
    <!-- Feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('files/assets/scss/partials/menu/_pcmenu.htm') }}">

    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css') }}">
    <!-- Này là cái gì -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

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
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- Themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- Ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
    <!-- Feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/feather/css/feather.css') }}">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}">
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">

@endsection
@section('content')
    <!-- Page body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Basic Inputs Validation start -->
                <div class="card">
                    <div class="card-header">
                        <h5>Basic Inputs Validation</h5>
                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>

                    </div>
                    <div class="card-block">
                        <form id="main" method="POST" action="{{ route('subtask.update',["SubtaskId" => $subtask->SubTaskId]) }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên nhiệm vụ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="SubTaskName" id="name" value="{{$subtask->SubTaskName}}">
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <!-- Input to store content -->
                            <input type="hidden" id="editor-content" name="Description" value="{{$subtask->Description}}" />
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Mô tả chi tiết</label>
                                <div class="col-sm-10">
                                    <!-- Thanh công cụ -->
                                    <div id="toolbar-container" class="toolbar-container">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <!-- Khu vực chỉnh sửa -->
                                    <div id="editor-container">{{$subtask->Description}}</div>
                                    <!-- Nút nhập file -->
                                    <div class="gr-bt d-flex align-center">
                                        <input type="file" id="file-input" accept=".txt,.json,.doc,.docx"
                                            class="m-0 h-auto mr-3" />
                                        <div class="btn btn-action save-button m-0 h-100" id="load-file">📥 Nhập Từ File
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Dự án</label>
                                <div class="col-sm-10">
                                    <select name="ProjectId" class="form-control">
                                        @foreach ($projects as $project)
                                        <option value="{{$project->ProjectId}}">{{$project->ProjectName}}</option>
                                            
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Công việc</label>
                                <div class="col-sm-10">
                                    <select name="TaskId" id="task-select" class="form-control">
                                            <option value="{{ $subtask->task->TaskId }}">{{ $subtask->task->TaskName }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thành viên được giao</label>
                                <div class="col-sm-10">
                                    <select name="member" id="member-select" class="form-control ">
                                        <option value="" disabled>-- Chọn thành viên --</option>
                                        @foreach ($members as $member)
                                            <option value="{{$member->UserId}}">{{$member->FullName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="repeat-password"
                                        name="StartDate" value="{{$subtask->StartDate}}">
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày kết thúc</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="email" name="DueDate" value="{{$subtask->DueDate}}">
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Độ ưu tiên</label>
                                <div class="col-sm-10">
                                    <select name="Priority" class="form-control">
                                        <option value="High" {{$subtask->Priority == "High" ? "selected" : ''}}>High</option>
                                        <option value="Medium" {{$subtask->Priority == "Medium" ? "selected" : ''}}>Medium</option>
                                        <option value="Low" {{$subtask->Priority == "Low" ? "selected" : ''}}>Low</option>

                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thành viên</label>
                                <div class="col-sm-10">
                                    <select name="members[] " class="form-control js-example-basic-multiple" multiple>
                                        @foreach ($members as $member)
                                        <option value="{{$member->UserId}}">{{$member->FullName}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div> --}}
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

    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}">
    </script>
    <!-- Select 2 js -->
    <script type="text/javascript" src="{{ asset('files/bower_components/select2/js/select2.full.min.js') }}"></script>
    <!-- Multiselect js -->
    <script type="text/javascript"
        src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('files/assets/js/jquery.quicksearch.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('files/assets/pages/advance-elements/select2-custom.js') }}"></script>
    <script src="{{ asset('files/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/vartical-layout.min.js') }}"></script>
    <script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/script.js') }}"></script>

    <!-- External libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('files/assets/pages/form-validation/validate.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>


    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script>
        // Khởi tạo Quill Editor
        const quill = new Quill('#editor-container', {
            modules: {
                toolbar: '#toolbar-container' // Gắn thanh công cụ tùy chỉnh
            },
            theme: 'snow',
            placeholder: 'Nhập nội dung tại đây...'
        });
        quill.on('text-change', function() {
            // Lấy nội dung HTML từ Quill editor
            const content = quill.root.innerHTML;

            // Cập nhật giá trị của input
            document.getElementById('editor-content').value = content;
        });

        document.getElementById('load-file').addEventListener('click', function() {
            const fileInput = document.getElementById('file-input');
            const file = fileInput.files[0];

            if (!file) {
                alert('Vui lòng chọn một file để nhập!');
                return;
            }

            const reader = new FileReader();

            // Xử lý file Word (.docx)
            if (file.name.endsWith('.docx')) {
                reader.onload = function(event) {
                    const arrayBuffer = event.target.result;

                    mammoth.convertToHtml({
                            arrayBuffer: arrayBuffer
                        })
                        .then(result => {
                            quill.root.innerHTML = result.value;
                            // Gán nội dung vào input
                            document.getElementById('editor-content').value = result.value;
                            console.log('Nội dung Word đã được nhập:', result.value);
                        })
                        .catch(err => {
                            console.error('Lỗi khi đọc file Word:', err);
                            alert('Không thể đọc file Word!');
                        });
                };

                reader.readAsArrayBuffer(file);
            }
            // Xử lý file JSON
            else if (file.name.endsWith('.json')) {
                reader.onload = function(event) {
                    let content = event.target.result;
                    try {
                        const jsonData = JSON.parse(content);
                        if (jsonData.content) {
                            quill.root.innerHTML = jsonData.content;
                        } else {
                            alert('File JSON không hợp lệ!');
                        }
                    } catch (error) {
                        console.error('Lỗi khi đọc JSON:', error);
                        alert('File JSON không hợp lệ!');
                    }
                };

                reader.readAsText(file);
            }
            // Xử lý file TXT
            else if (file.name.endsWith('.txt')) {
                reader.onload = function(event) {
                    const content = event.target.result;
                    quill.root.innerHTML = `<p>${content.replace(/\n/g, '</p><p>')}</p>`;
                };

                reader.readAsText(file);
            }
            // Định dạng không hỗ trợ
            else {
                alert('Định dạng file không được hỗ trợ! Chọn file .txt, .json hoặc .docx');
            }
        });

       
    </script>
@endsection
