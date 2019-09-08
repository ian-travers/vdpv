<?php

namespace Tests\Feature;

use App\Detainer;
use App\User;
use App\Wagon;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Tests\Setup\WagonFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageWagonsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function guest_cannot_manage_wagons()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->get('/wagons')->assertRedirect('/login');
        $this->get('/wagons/create')->assertRedirect('/login');
        $this->get($wagon->path() .'/edit')->assertRedirect('/login');
        $this->get($wagon->path())->assertRedirect('/login');
        $this->post('/wagons', $wagon->toArray())->assertRedirect('/login');
    }

    /** @test */
    function a_wagons_manager_can_create_a_wagon()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = [
            'inw' => $this->faker->numerify('########'),
            'arrived_at' => Carbon::parse('-2 hours'),
            'detained_at' => Carbon::parse('-1 hours'),
            'released_at' => null,
            'departed_at' => null,
            'detainer_id' => factory(Detainer::class)->create()->id,
            'reason' => 'It has no main shipment',
            'cargo' => 'Gasoline',
            'forwarder' => 'BTLS',
            'ownership' => 'BCH',
            'departure_station' => 'Shkirotava',
            'destination_station' => 'Manhali',
            'taken_measure' => 'Nothing to do',
        ];

        $response = $this->post('/wagons', $attributes);

        $this->get('/wagons/create')->assertOk();
        $response->assertRedirect('/wagons');
        $this->assertDatabaseHas('wagons', $attributes);
        $this->get('/wagons')->assertSee($attributes['inw']);
    }
    
    /** @test */ 
    function a_wagons_manager_can_update_a_wagon()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $wagon = app(WagonFactory::class)->createdBy($manager)->create();

        $this->actingAs($wagon->creator)
            ->patch($wagon->path(), $attributes = [
                'inw' => '12345678',
                'arrived_at' => Carbon::parse('-1 min'),
                'detained_at' => Carbon::now(),
                'released_at' => Carbon::now(),
                'departed_at' => Carbon::now(),
                'detainer_id' => Detainer::first()->id,
                'reason' => 'changed',
                'cargo' => 'changed',
                'forwarder' => 'changed',
                'ownership' => 'changed',
                'departure_station' => 'changed',
                'destination_station' => 'changed',
                'taken_measure' => 'changed',
            ])
            ->assertRedirect(session()->get('url.intended'));

        $this->get($wagon->path() . '/edit')->assertOk();
        $this->assertDatabaseHas('wagons', $attributes);
    }

    /** @test */
    function a_wagons_manager_can_delete_their_wagons()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $wagon = app(WagonFactory::class)->createdBy($manager)->create();

        $this->assertDatabaseHas('wagons', $wagon->toArray());

        $this->delete('/wagons/' . $wagon->id)
            ->assertRedirect('/wagons');

        $this->assertDatabaseMissing('wagons', $wagon->toArray());
    }

    /** @test */
    function an_unauthorized_user_cannot_delete_other_wagon()
    {
        $this->signIn();

        $wagon = app(WagonFactory::class)->create();

        $this->delete('/wagons/' . $wagon->id)
            ->assertStatus(Response::HTTP_FORBIDDEN);

        $this->assertDatabaseHas('wagons', $wagon->toArray());
    }
    
    /** @test */
    function a_wagon_manager_can_view_their_wagons()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $wagon = app(WagonFactory::class)->createdBy($manager)->create();

        $this->get($wagon->path())->assertOk();
    }

    /** @test */
    function an_authenticated_user_cannot_view_other_wagons()
    {
        $this->signIn();

        $wagon = app(WagonFactory::class)->create();

        $this->get($wagon->path())->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function a_wagon_requires_an_inw()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = factory(Wagon::class)->raw(['inw' => '', 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');
    }

    /** @test */
    function a_wagon_inw_is_exactly_8_digits()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = factory(Wagon::class)->raw(['inw' => '1234567', 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');

        $attributes = factory(Wagon::class)->raw(['inw' => '123456789', 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');

        $attributes = factory(Wagon::class)->raw(['inw' => '123456aa', 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');
    }

    /** @test */
    function a_wagon_requires_a_detained_at()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = factory(Wagon::class)->raw(['detained_at' => null, 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('detained_at');
    }

    /** @test */
    function a_wagon_requires_a_detainer()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = factory(Wagon::class)->raw(['detainer_id' => '', 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('detainer_id');
    }

    /** @test */
    function a_local_wagon_has_the_same_detained_and_released_times()
    {
        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = factory(Wagon::class)->raw(['detainer_id' => '7']);

        $this->post('/wagons', $attributes)->assertStatus(Response::HTTP_FOUND);

        $wagon = Wagon::find(1);

        $this->assertInstanceOf("Carbon\Carbon", $wagon->detained_at);
        $this->assertInstanceOf("Carbon\Carbon", $wagon->released_at);

        $this->assertEquals($wagon->detained_at, $wagon->released_at);
    }

    /** @test */
    function a_local_wagon_cannot_be_detained_and_always_released()
    {
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $attributes = factory(Wagon::class)->raw(['detainer_id' => '7', 'creator_id' => $manager->id]);

        $this->post('/wagons', $attributes)->assertStatus(Response::HTTP_FOUND);

        $wagon = Wagon::find(1);

        $this->assertTrue($wagon->isReleased());
        $this->assertFalse($wagon->isDeparted());
        $this->assertFalse($wagon->isDetained());
    }

    /** @test */
    function a_manager_can_manage_wagon_created_by_local_manager()
    {
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $localManager = factory(User::class)->create(['role' => User::ROLE_LOCAL_WAGONS_MANAGER]);
        $this->signIn($localManager);

        $wagon = app(WagonFactory::class)->createdBy($localManager)->create();

        $this->assertDatabaseHas('wagons', $wagon->toArray());

        $manager = factory(User::class)->create(['role' => User::ROLE_WAGONS_MANAGER]);
        $this->signIn($manager);

        $this->get('/wagons')->assertSee($wagon->inw);
    }
}
