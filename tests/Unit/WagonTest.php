<?php

namespace Tests\Unit;

use App\User;
use App\Wagon;
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
    function is_has_a_detainer_name()
    {
        $wagon = app(WagonFactory::class)->create();

        $this->assertEquals(Wagon::$detainers[$wagon->detained_by], $wagon->getDetainer());

        $wagon->detained_by = 'fake';

        $this->assertEquals(Wagon::UNKNOWN_DETAINER, $wagon->getDetainer());
    }
}
