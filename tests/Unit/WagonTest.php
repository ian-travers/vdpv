<?php

namespace Tests\Unit;

use App\User;
use App\Wagon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WagonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_has_a_path()
    {
        $wagon = factory(Wagon::class)->create();

        $this->assertEquals("/wagons/{$wagon->id}", $wagon->path());
    }

    /** @test */
    function it_belongs_to_an_owner()
    {
        /** @var Wagon $wagon */
        $wagon = factory(Wagon::class)->create();

        $this->assertInstanceOf(User::class, $wagon->creator);
    }
}
