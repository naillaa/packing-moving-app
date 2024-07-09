<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_get_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/profile');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'data' => [
                         'username' => $user->username,
                         // tambahkan asser untuk data profil lainnya
                     ]
                 ]);
    }

    /** @test */
    public function user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/profile/update', [
            'fullname' => 'Updated Name',
            'phone' => '987654321',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Profile updated successfully!',
                     'data' => [
                         'fullname' => 'Updated Name',
                         'phone' => '987654321',
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'fullname' => 'Updated Name',
            'phone' => '987654321',
        ]);
    }
}
