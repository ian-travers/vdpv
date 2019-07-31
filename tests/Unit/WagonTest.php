<?php

namespace Tests\Unit;

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
}
