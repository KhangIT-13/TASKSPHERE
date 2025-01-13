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
                    <form method="POST" action="{{ route('auth.register') }}" class="md-float-material form-material">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('files/assets/images/logo.png') }}" width="60px" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Đăng ký tài khoản</h3>
                                    </div>
                                </div>
                                <div class="row m-b-20">
                                    <div class="col-md-6">
                                        <a href="#!" class="btn btn-facebook m-b-20 btn-block waves-effect waves-light">
                                            <i class="icofont icofont-social-facebook"></i>Facebook
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#!" class="btn btn-twitter m-b-0 btn-block waves-effect waves-light">
                                            <i class="icofont icofont-social-google"></i>Google
                                        </a>
                                    </div>
                                </div>
                                <p class="text-muted text-center p-b-5">Đăng ký với thông tin của bạn</p>
                                
                                <!-- Username input -->
                                <div class="form-group form-primary">
                                    <input type="text" name="username" class="form-control" required="" placeholder="Tên đăng nhập">
                                    <span class="form-bar"></span>
                                    @error('user-name') 
                                        <div class="text-danger">{{ $message }}</div> 
                                    @enderror
                                </div>
                                
                                <!-- Email input -->
                                <div class="form-group form-primary">
                                    <input type="email" name="email" class="form-control" required="" placeholder="Email">
                                    <span class="form-bar"></span>
                                    @error('email') 
                                        <div class="text-danger">{{ $message }}</div> 
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Password input -->
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control" required="" placeholder="Mật khẩu">
                                            <span class="form-bar"></span>
                                            @error('password') 
                                                <div class="text-danger">{{ $message }}</div> 
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Confirm Password input -->
                                        <div class="form-group form-primary">
                                            <input type="password" name="password_confirmation" class="form-control" required="" placeholder="Xác nhận mật khẩu">
                                            <span class="form-bar"></span>
                                            @error('password_confirmation') 
                                                <div class="text-danger">{{ $message }}</div> 
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and conditions checkbox -->
                                <div class="row m-t-25 text-left">
                                    <div class="col-md-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="" name="terms">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Tôi đã đọc và đồng ý với <a href="#">Điều khoản và dịch vụ.</a></span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Newsletter checkbox -->
                                    {{-- <div class="col-md-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="" name="newsletter">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Send me the <a href="#">Newsletter</a> weekly.</span>
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>

                                <!-- Sign-up button -->
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Đăng ký</button>
                                    </div>
                                </div>
                                
                                <hr>

                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Cảm ơn bạn.</p>
                                        <p class="text-inverse text-left">Bạn đã có tài khoản ?<a href="{{route('auth.login')}}"><b class="f-w-600">Đăng nhập tại đây!</b></a></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('files/assets/images/auth/Logo-small-bottom.png') }}" alt="small-logo.png">
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
