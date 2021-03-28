<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Throwable;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Throwable
     */
    public function test_user_has_correct_validation_on_create()
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = 'password';
        
        $response = $this->postJson(route('register.store'), $user);
        $response->assertStatus(201);
        
        $this->assertDatabaseHas('users', [ 'id' => $response->decodeResponseJson()['data']['id'], 'username' => $user['username'] ]);
    }
}
