<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn(User $user = null): User
    {
        $user = $user ?: factory(User::class)->create();
        $this->actingAs($user);

        return $user;
    }
}
