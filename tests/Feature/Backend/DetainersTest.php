<?php

namespace Tests\Feature\Backend;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CanAssertFlash;

class DetainersTest extends TestCase
{
    use RefreshDatabase;
    use CanAssertFlash;

    /** @test */
    function a_guest_cannot_see_detainers_page()
    {
        $this->get('/adm/detainers')->assertRedirect('/login');
    }

    /** @test */
    function an_unauthenticated_user_cannot_see_detainers_page()
    {
        $this->signIn();
        $this->get('/adm/detainers')->assertStatus(Response::HTTP_FOUND);
        $this->assertFlash('warning', "Недостаточно прав");

        $wagonsManager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($wagonsManager);
        $this->get('/adm/detainers')->assertStatus(Response::HTTP_FOUND);
        $this->assertFlash('warning', "Недостаточно прав");

        $localWagonsManager = factory(User::class)->create(['role' => User::ROLE_LOCAL_WAGONS_MANAGER]);
        $this->signIn($localWagonsManager);
        $this->get('/adm/detainers')->assertStatus(Response::HTTP_FOUND);
        $this->assertFlash('warning', "Недостаточно прав");
    }

    /** @test */
    function a_station_administrator_can_view_detainers_page()
    {
        $stationAdmin = factory(User::class)->create(['role' => User::ROLE_STATION_ADMIN]);

        $this->signIn($stationAdmin);
        $this->get('/adm/detainers')->assertOK();
    }

    /** @test */
    function an_admin_can_view_detainers_page()
    {
        $admin = factory(User::class)->create(['is_admin' => true]);

        $this->signIn($admin);
        $this->get('/adm/detainers')->assertOK();
    }
}
