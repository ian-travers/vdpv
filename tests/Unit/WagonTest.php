<?php

namespace Tests\Unit;

use App\User;
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
    function it_belongs_to_an_owner()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertInstanceOf(User::class, $wagon->creator);
    }
}
