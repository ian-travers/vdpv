<?php

namespace Tests\Unit;

use App\Detainer;
use App\User;
use Carbon\Carbon;
use Tests\Setup\WagonFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WagonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_a_path()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertEquals("/wagons/{$wagon->id}", $wagon->path());
    }

    /** @test */
    function it_belongs_to_an_creator()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertInstanceOf(User::class, $wagon->creator);
    }

    /** @test */
    function it_belongs_to_detainer()
    {
        $wagon = app(WagonFactory::class)->create();

        $detainer = Detainer::find($wagon->detainer_id);

        $this->assertInstanceOf(Detainer::class, $detainer);
    }
    
    /** @test */ 
    function check_arrived_at_setter()
    {
        $wagon = app(WagonFactory::class)->create();

        $d = Carbon::parse('+20 min');

        $wagon->setAttribute('arrived_at', $d);

        $this->assertEquals($wagon->arrived_at, $d);

        $this->expectException(\InvalidArgumentException::class);
        $wagon->setAttribute('arrived_at', '01.01.2019 12:55:00');
    }
}
