<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('สามารถสมัครสมาชิกและถูกจับเข้าสู่ระบบได้', function () {
    // 1. จำลองการกรอกฟอร์มสมัครสมาชิก
    $response = $this->post('/register', [
        'name' => 'Somchai Test',
        'email' => 'somchai@test.com',
        'password' => 'password123',
    ]);

    // 2. คาดหวังว่ามันต้องเด้งไปหน้าแรก
    $response->assertRedirect('/');

    // 3. คาดหวังว่าในฐานข้อมูลต้องมีอีเมลนี้โผล่มา
    $this->assertDatabaseHas('users', [
        'email' => 'somchai@test.com'
    ]);
});

it('สามารถเข้าสู่ระบบด้วยรหัสผ่านที่ถูกต้องได้', function () {
    // 1. จำลองสร้าง User ในฐานข้อมูล (ใช้ Factory ที่ Laravel เตรียมไว้ให้)
    $user = User::factory()->create([
        'password' => bcrypt('password123')
    ]);

    // 2. ยิงข้อมูลเข้าหน้า Login
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    // 3. ตรวจสอบว่าเข้าสู่ระบบสำเร็จ
    $response->assertRedirect('/');
    $this->assertAuthenticatedAs($user); // ตรวจว่าระบบจำได้ไหมว่าคนนี้ล็อกอิน
});

it('สามารถออกจากระบบได้', function () {
    // 1. สร้าง User และจำลองว่ากำลังล็อกอินอยู่ (actingAs)
    $user = User::factory()->create();

    // 2. กดยิงคำสั่ง Logout
    $response = $this->actingAs($user)->post('/logout');

    // 3. ตรวจสอบว่าเด้งกลับหน้า login และสถานะคือไม่ได้ล็อกอิน (Guest)
    $response->assertRedirect('/login');
    $this->assertGuest();
});
