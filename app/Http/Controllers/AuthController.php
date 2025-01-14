<?php

namespace App\Http\Controllers;

use App\Mail\ForgotUsernameMail;
use App\Models\User;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function accessdenied(){
        return view("auth.accessdenied");
    }
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login'); // Đảm bảo bạn trả về view login
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['Email' => $request->email, 'password' => $request->password])) {

            // Kiểm tra xem người dùng đã đăng nhập và có vai trò 'admin' không
            if (Auth::check() && Auth::user()->Role == 'Admin') {
                // Nếu là admin, chuyển hướng đến route admin.index
                return redirect()->route('admin.index');
            }


            return redirect()->intended('home'); // Đăng nhập thành công, chuyển hướng đến trang dashboard
        }

        return back()->withErrors(['error' => 'Thông tin đăng nhập không đúng']); // Thông báo lỗi nếu đăng nhập thất bại
    }

    // Hiển thị form đăng ký (Optional)
    public function showRegisterForm()
    {
        return view('auth.register'); // Trả về view đăng ký (nếu có)
    }

    // Xử lý đăng ký (Optional)
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'username' => 'required|string|max:100',
        ]);

        // Tạo mới người dùng
        $user = User::create([
            'FullName' => $request->input('username'),
            'Email' => $request->input('email'),
            'PasswordHash' => Hash::make($request->input('password')),
        ]);
        // dd($user);
        // Đăng nhập ngay sau khi tạo tài khoản
        Auth::login($user);

        return redirect()->route('home'); // Chuyển hướng đến trang dashboard
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->route('auth.login'); // Quay lại trang đăng nhập
    }


    public function showForgotPasswordForm()
    {
        return view('auth.forgotpass');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Tạo mã reset
        $token = Str::random(60);

        // Lưu mã vào session hoặc gửi qua email mà không cần bảng password_resets
        $this->storeResetToken($request->email, $token);

        // Gửi email với link reset
        $link = route('auth.resetpass', ['token' => $token]);
        // dd($link);

        Mail::send('emails.reset-password', ['link' => $link], function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Reset Password Link');
        });

        return view('auth.wait-reset');
        return back()->with('status', 'Chúng tôi đã gửi liên kết khôi phục mật khẩu qua email!');
    }

    protected function storeResetToken($email, $token)
    {
        // Lưu token vào session hoặc một cách khác để kiểm tra
        session(['reset_token' => $token, 'reset_email' => $email]);
    }

    public function showResetPasswordForm($token)
    {
        if ($token !== session('reset_token')) {
            return redirect()->route('auth.forgotpass')->withErrors(['token' => 'Token không hợp lệ']);
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);
        // Kiểm tra token từ session
        if ($request->token !== session('reset_token') || $request->email !== session('reset_email')) {
            return back()->withErrors(['token' => 'Token không hợp lệ']);
        }

        // Cập nhật mật khẩu người dùng
        $user = User::where('email', $request->email)->first();
        // dd($user);
        if ($user) {
            $user->PasswordHash = bcrypt($request->password);
            $user->save();

            // Xóa session sau khi reset mật khẩu thành công
            session()->forget('reset_token');
            session()->forget('reset_email');

            return redirect()->route('auth.login')->with('status', 'Mật khẩu đã được cập nhật thành công!');
        }

        return back()->withErrors(['email' => 'Không tìm thấy người dùng']);
    }
}
