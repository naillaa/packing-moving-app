<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'username' => 'testuser',
            'fullname' => 'Test User',
            'phone' => '123456789',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Register berhasil, silahkan login!',
                 ]);

        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'fullname' => 'Test User',
        ]);
    }
}
