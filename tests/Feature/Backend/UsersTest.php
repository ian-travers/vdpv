<?php

namespace Tests\Feature\Backend;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\CanAssertFlash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    use CanAssertFlash;

    /** @test */
    function an_admin_can_view_users_table()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);

        $this->actingAs($admin)->get('/adm/users')
            ->assertSee('Администрирование')
            ->assertOk();
    }

    /**
     * @test
     * @expectedException \Illuminate\Auth\AuthenticationException
     */
    function a_guest_cannot_view_users_table()
    {
        $this->withoutExceptionHandling();

        $this->get('/adm/users')
            ->assertRedirect(route('login'));
    }

    /** @test */
    function an_unauthenticated_user_cannot_view_users_table()
    {
        $this->signIn();

        $this->get('/adm/users')
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertFlash('warning', "Недостаточно прав");
    }
}
