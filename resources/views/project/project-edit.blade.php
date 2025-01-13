@extends('layout.app')
@section('title', 'Chi tiết dự án')
@section('css')
    <!-- Favicon icon -->
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

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">

    <!-- Custom Scrollbar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">
    <!-- Select2 css -->
    <link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css') }}">
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css') }}">

    <!-- Quill editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">

    <!-- Custom Styles for Quill Editor -->
    <style>
        /* Tùy chỉnh giao diện */
        #editor-container {
            height: 400px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

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

        .content-output {
            margin-top: 30px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            background-color: #fafafa;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
        }

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

        .resizable-img {
            resize: both;
            overflow: auto;
            border: 1px dashed #ccc;
            padding: 5px;
        }

        .ql-editor.ql-blank::before {
            color: #999;
            font-style: italic;
        }

        .ql-container {
            border-radius: 8px;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 20px;
        }

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
                <div class="card">
                    <div class="card-header">
                        <h5>Basic Inputs Validation</h5>
                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>

                    </div>
                    <div class="card-block">
                        <form id="main" method="POST" action="{{ route('project.update', $project->ProjectId) }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tên dự án</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ProjectName" id="name"
                                        placeholder="Text Input Validation" value="{{ $project->ProjectName }}">
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <!-- Input to store content -->
                            <input type="hidden" id="editor-content" name="Description" value="{{$project->Description}}"/>
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
                                    <div id="editor-container">
                                        {!! $project->Description !!}
                                    </div>
                                    <!-- Nút nhập file -->
                                    <div class="gr-bt d-flex align-center">
                                        <input type="file" id="file-input" accept=".txt,.json,.doc,.docx"
                                            class="m-0 h-auto mr-3" />
                                        <div class="btn btn-action save-button m-0 h-100" id="load-file">📥 Nhập Từ File
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Danh mục</label>
                                <div class="col-sm-10">
                                    <select name="CategoryId" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->CategoryId }}"
                                                {{ $category->CategoryId == $project->CategoryId ? 'selected' : '' }}>
                                                {{ $category->CategoryName }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="repeat-password"
                                        name="StartDate" placeholder="Repeat Password"
                                        value="{{ $project->StartDate }}">
                                    <span class="messages"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ngày kết thúc</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="email" name="EndDate"
                                        placeholder="Enter valid e-mail address" value="{{ $project->EndDate }}">
                                    <span class="messages"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thành viên</label>
                                <div class="col-sm-10">
                                    <select name="members[] " class="form-control js-example-basic-multiple" multiple>
                                        @foreach ($members as $member)
                                            {{-- <option value="{{$member->UserId}} {{$member in $project->members ? 'selected':''}}">{{$member->FullName}}</option> --}}
                                            <option value="{{ $member->UserId }}"
                                                {{ in_array($member->UserId, old('members', $currentMembers)) ? 'selected' : '' }}>
                                                {{ $member->FullName }}
                                            </option>
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

    <!-- Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

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
