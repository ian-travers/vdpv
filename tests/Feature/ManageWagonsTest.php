<?php

namespace Tests\Feature;

use App\Wagon;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class ManageWagonsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function a_user_can_create_a_wagon()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());

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
            'is_empty' => false
        ];

        $response = $this->post('/wagons', $attributes);

        $response->assertRedirect('/wagons');
        $this->assertDatabaseHas('wagons', $attributes);

        $this->get('/wagons')->assertSee($attributes['inw']);
    }

    /** @test */
    function guest_cannot_add_a_wagon()
    {
        $attributes = factory(Wagon::class)->raw();

        $this->post('/wagons', $attributes)->assertRedirect('/login');
    }

    /** @test */
    function guest_cannot_view_wagons()
    {
        $this->get('/wagons')->assertRedirect('/login');
    }

    /** @test */
    function guest_cannot_view_a_single_wagons()
    {
        /** @var Wagon $wagon */
        $wagon = factory(Wagon ::class)->create();
        $this->get($wagon->path())->assertRedirect('/login');
    }

    /** @test */
    function a_user_can_view_their_wagons()
    {
        $this->be(factory(User::class)->create());

        /** @var Wagon $wagon */
        $wagon = factory(Wagon::class)->create(['creator_id' => Auth::id()]);

        $this->get($wagon->path())
            ->assertSee($wagon->inw)
            ->assertSee($wagon->detained_by)
            ->assertSee($wagon->reason);
    }

    /** @test */
    function an_authenticated_user_cannot_view_other_wagons()
    {
        $this->be(factory(User::class)->create());

        /** @var Wagon $wagon */
        $wagon = factory(Wagon::class)->create();

        $this->get($wagon->path())->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function a_wagon_requires_an_inw()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['inw' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('inw');
    }

    /** @test */
    function a_wagon_inw_is_exactly_8_digits()
    {
        $this->actingAs(factory(User::class)->create());
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
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['arrived_at' => null]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('arrived_at');
    }

    /** @test */
    function a_wagon_requires_a_detained_at()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['detained_at' => null]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('detained_at');
    }

    /** @test */
    function a_wagon_requires_a_detained_by()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['detained_by' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('detained_by');
    }

    /** @test */
    function a_wagon_requires_a_departure_station()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['departure_station' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('departure_station');
    }

    /** @test */
    function a_wagon_requires_a_destination_station()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['destination_station' => '']);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('destination_station');
    }

    /** @test */
    function a_wagon_required_an_is_empty_mark()
    {
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Wagon::class)->raw(['is_empty' => null]);

        $this->post('/wagons', $attributes)->assertSessionHasErrors('is_empty');
    }
}
