<?php

namespace Tests\Feature;

use App\Wagon;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Tests\Setup\WagonFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

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
    function a_user_can_create_a_wagon()
    {
        $this->signIn();

        $attributes = [
            'inw' => $this->faker->numerify('########'),
            'arrived_at' => Carbon::parse('-2 hours'),
            'detained_at' => Carbon::parse('-1 hours'),
            'released_at' => null,
            'departed_at' => null,
            'detained_by' => 'Customs',
            'reason' => 'It has no main shipment',
            'cargo' => 'Gasoline',
            'forwarder' => 'BTLS',
            'ownership' => 'BCH',
            'departure_station' => 'Shkirotava',
            'destination_station' => 'Manhali',
            'taken_measure' => 'Nothing',
        ];

        $response = $this->post('/wagons', $attributes);

        $this->get('/wagons/create')->assertOk();
        $response->assertRedirect('/wagons');
        $this->assertDatabaseHas('wagons', $attributes);
        $this->get('/wagons')->assertSee($attributes['inw']);
    }
    
    /** @test */ 
    function a_user_can_update_a_wagon()
    {
        $this->withoutExceptionHandling();

        $wagon = app(WagonFactory::class)->create();

        $this->actingAs($wagon->creator)
            ->patch($wagon->path(), $attributes = [
                'inw' => '12345678',
                'arrived_at' => Carbon::now(),
                'detained_at' => Carbon::now(),
                'released_at' => Carbon::now(),
                'departed_at' => Carbon::now(),
                'detained_by' => 'changed',
                'reason' => 'changed',
                'cargo' => 'changed',
                'forwarder' => 'changed',
                'ownership' => 'changed',
                'departure_station' => 'changed',
                'destination_station' => 'changed',
                'taken_measure' => 'changed',
            ])
            ->assertRedirect(route('wagons.index'));

        $this->get($wagon->path() . '/edit')->assertOk();
        $this->assertDatabaseHas('wagons', $attributes);
    }

    /** @test */
    function a_user_can_delete_their_wagons()
    {
        $this->signIn();

        $wagon = app(WagonFactory::class)->createdBy(Auth::user())->create();

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
    function a_user_can_view_their_wagons()
    {
        $this->signIn();

        $wagon = app(WagonFactory::class)->createdBy(Auth::user())->create();

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
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['inw' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');
    }

    /** @test */
    function a_wagon_inw_is_exactly_8_digits()
    {
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['inw' => '1234567']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');

        $attributes = factory(Wagon::class)->raw(['inw' => '123456789']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');

        $attributes = factory(Wagon::class)->raw(['inw' => '123456aa']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');
    }

    /** @test */
    function a_wagon_requires_an_arrived_at()
    {
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['arrived_at' => null]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('arrived_at');
    }

    /** @test */
    function a_wagon_requires_a_detained_at()
    {
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['detained_at' => null]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('detained_at');
    }

    /** @test */
    function a_wagon_requires_a_detained_by()
    {
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['detained_by' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('detained_by');
    }

    /** @test */
    function a_wagon_requires_a_departure_station()
    {
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['departure_station' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('departure_station');
    }

    /** @test */
    function a_wagon_requires_a_destination_station()
    {
        $this->signIn();
        $attributes = factory(Wagon::class)->raw(['destination_station' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('destination_station');
    }

}
