<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;  // Đảm bảo cơ sở dữ liệu được reset cho mỗi test

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReturnsSuccessfulResponse()
    {
        // Giả lập người dùng đã đăng nhập
        $user = AuthUser::factory()->create();  // Tạo người dùng giả
        $this->actingAs($user);  // Đăng nhập người dùng giả

        // Kiểm tra response
        $response = $this->get('/');
        $response->assertStatus(200);  // Mong đợi mã trạng thái 200
    }
}
