<?php

use App\Models\User;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('ผู้ใช้จะมองเห็นเฉพาะงานของตัวเองในหน้าแรกเท่านั้น', function () {
    // สร้าง User 2 คน
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    // สร้างงานให้แต่ละคน
    Todo::create(['title' => 'งานของ User 1', 'user_id' => $user1->id]);
    Todo::create(['title' => 'งานของ User 2', 'user_id' => $user2->id]);

    // จำลองให้ User 1 ล็อกอินเข้าหน้าแรก
    $response = $this->actingAs($user1)->get('/');

    // ต้องเห็นงานตัวเอง แต่ "ห้าม" เห็นงานคนอื่น!
    $response->assertSee('งานของ User 1');
    $response->assertDontSee('งานของ User 2');
});

it('สามารถเพิ่มงานใหม่ได้', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/todos', [
        'title' => 'ลุยเรียน Pest ให้จบ',
    ]);

    // ตรวจสอบว่างานลงฐานข้อมูลจริงๆ
    $this->assertDatabaseHas('todos', [
        'title' => 'ลุยเรียน Pest ให้จบ',
        'user_id' => $user->id,
    ]);
});

it('สามารถแก้ไขงานของตัวเองได้', function () {
    $user = User::factory()->create();
    $todo = Todo::create(['title' => 'ชื่องานเก่า', 'user_id' => $user->id]);

    $response = $this->actingAs($user)->put("/todos/{$todo->id}", [
        'title' => 'ชื่องานใหม่',
    ]);

    // ตรวจสอบว่าชื่องานเปลี่ยนไปแล้ว
    $this->assertDatabaseHas('todos', [
        'id' => $todo->id,
        'title' => 'ชื่องานใหม่',
    ]);
});

// 🛡️ เทสต์ดักจับ Hacker!
it('ป้องกันไม่ให้ผู้ใช้อื่นแอบมาแก้ไขงานที่ไม่ใช่ของตัวเอง', function () {
    $hacker = User::factory()->create();
    $victim = User::factory()->create();

    // งานนี้เป็นของเหยื่อ
    $todo = Todo::create(['title' => 'ความลับของเหยื่อ', 'user_id' => $victim->id]);

    // แฮกเกอร์ล็อกอินเข้ามา แล้วแอบยิงข้อมูลไปแก้ดื้อๆ
    $response = $this->actingAs($hacker)->put("/todos/{$todo->id}", [
        'title' => 'โดนแฮกแล้วจ้า 555',
    ]);

    // ต้องโดนเตะออกด้วย Status 403 (Forbidden: ไม่มีสิทธิ์)
    $response->assertStatus(403);

    // ฐานข้อมูลต้องเหมือนเดิม ไม่ถูกเปลี่ยน
    $this->assertDatabaseHas('todos', [
        'id' => $todo->id,
        'title' => 'ความลับของเหยื่อ',
    ]);
});

it('สามารถลบงานของตัวเองได้', function () {
    $user = User::factory()->create();
    $todo = Todo::create(['title' => 'งานที่เตรียมลบ', 'user_id' => $user->id]);

    $response = $this->actingAs($user)->delete("/todos/{$todo->id}");

    // ตรวจสอบว่าข้อมูลหายไปจากระบบแล้ว
    $this->assertDatabaseMissing('todos', [
        'id' => $todo->id
    ]);
});
