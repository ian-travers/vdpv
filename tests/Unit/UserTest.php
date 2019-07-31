<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */ 
    function a_user_has_wagons()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->wagons);
    }
}
