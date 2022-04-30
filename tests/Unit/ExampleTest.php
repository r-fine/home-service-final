<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::make([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
