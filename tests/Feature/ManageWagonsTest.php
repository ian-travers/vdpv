<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageWagonsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function a_user_can_create_a_wagon()
    {
        $this->withoutExceptionHandling();

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
}
