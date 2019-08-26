<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackendTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_view_backend_dashboard()
    {
        $this->withoutExceptionHandling();

        /** @var User $admin */
        $admin = factory(User::class)->create();

        $admin->setAdminRights();

        $this->signIn($admin);

        $this->get('/adm')->assertOk();


    }
}
