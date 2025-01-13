<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adminty - Premium Admin Template by Colorlib</title>
    <!-- Meta and responsive -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android">
    <meta name="author" content="#">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('files/assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">

    <!-- Themify icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">

    <!-- Ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">

</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    
                    <!-- Authentication card start -->
                    <form action="{{ route('auth.resetpassword') }}" method="POST"
                        class="md-float-material form-material">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        {{-- <div class="text-center">
                            <img src="{{ asset('files/assets/images/logo.png') }}" alt="logo.png">
                        </div> --}}
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Đặt lại mật khẩu của bạn</h3>
                                    </div>
                                </div>


                                <!-- Email input -->
                                <div class="form-group form-primary">
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email') }}" required placeholder="Email">

                                    <span class="form-bar"></span>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Password input -->
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" required placeholder="Mật khẩu mới"
                                                class="form-control" required="">
                                            <span class="form-bar"></span>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Confirm Password input -->
                                        <div class="form-group form-primary">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Xác nhận mật khẩu" required="">
                                            <span class="form-bar"></span>
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <!-- Sign-up button -->
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Xác
                                            nhận</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <!-- Authentication card end -->
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery and other JS files -->
    <script type="text/javascript" src="{{ asset('files/bower_components/jquery/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('files/assets/js/common-pages.js') }}"></script>

</body>

</html>
