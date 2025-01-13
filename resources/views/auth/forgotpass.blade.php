<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quên mật khẩu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="..\files\bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\icon\themify-icons\themify-icons.css">
    <link rel="stylesheet" type="text/css" href="..\files\assets\css\style.css">
</head>
<body class="fix-menu">
    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('auth.forgotpass') }}" method="POST">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('files/assets/images/logo.png') }}" width="60px" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Khôi phục mật khẩu</h3>
                                    </div>
                                </div>

                                <div class="form-group form-primary">
                                    <input type="email" name="email" class="form-control" required="" placeholder="Địa chỉ Email của bạn">
                                    <span class="form-bar"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Khôi phục mật khẩu</button>
                                    </div>
                                </div>

                                <p class="f-w-600 text-right">Quay lại <a href="{{ route('auth.login') }}">Đăng nhập</a>.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
