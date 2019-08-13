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

    /** @test */
    function check_detained_time()
    {
        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detainer_id' => 1,
            'detained_at' => Carbon::parse('-11 hours')
        ]);

        $this->assertEquals(11, $wagon->detainedInHours());

        $wagon->update([
            'departed_at' => Carbon::parse('-2 hours')
        ]);

        $this->assertEquals(9, $wagon->fresh()->detainedInHours());

    }

    /** @test */
    function check_detained_long_time()
    {
        // IMPORTANT: We need to populate detainers table before run this test
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detainer_id' => 1,
            'detained_at' => Carbon::parse('-25 hours')
        ]);

        $this->assertEquals(1, $wagon->detainedLongInHours());

        $wagon->update([
            'detainer_id' => 7, // local wagon
        ]);

        $this->assertEquals(1, $wagon->detainedLongInHours());

        $wagon->update([
            'released_at' => Carbon::parse('-15 hours')
        ]);

        $this->assertEquals(0, $wagon->fresh()->detainedLongInHours());
    }

    /** @test */
    function check_detained_long_time_part_2()
    {
        // IMPORTANT: We need to populate detainers table before run this test
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detainer_id' => 1,
            'detained_at' => Carbon::parse('-55 hours')
        ]);

        $this->assertEquals(31, $wagon->detainedLongInHours());

        $wagon->update([
            'detainer_id' => 7,
        ]);

        $this->assertEquals(31, $wagon->detainedLongInHours());

        $wagon->update([
            'released_at' => Carbon::parse('-30 hours')
        ]);

        $this->assertEquals(6, $wagon->fresh()->detainedLongInHours());
    }

    /** @test */
    function check_detained_time_and_long_time_of_the_departed_wagons()
    {
        // IMPORTANT: We need to populate detainers table before run this test
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $wagon->update([
            'detainer_id' => 1,
            'detained_at' => Carbon::parse('-55 hours'),
            'departed_at' => Carbon::parse('-5 hours')
        ]);

        $this->assertEquals(26, $wagon->detainedLongInHours());

        $wagon->update([
            'detainer_id' => 7,
        ]);

        $this->assertEquals(26, $wagon->detainedLongInHours());

        $wagon->update([
            'released_at' => Carbon::parse('-31 hours')
        ]);

        $this->assertEquals(2, $wagon->fresh()->detainedLongInHours());
    }

    /** @test */
    function check_is_detained_long_time()
    {
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $this->assertFalse($wagon->isDetainedLong());

        $wagon->update([
            'detainer_id' => 1,
            'detained_at' => Carbon::parse('-45 hours'),
        ]);

        $this->assertTrue($wagon->isDetainedLong());

        $wagon->update([
            'departed_at' => Carbon::parse('-10 hours'),
        ]);

        $this->assertTrue($wagon->isDetainedLong());

        $wagon->update([
            'departed_at' => Carbon::parse('-35 hours'),
        ]);

        $this->assertFalse($wagon->isDetainedLong());
    }

    /** @test */
    function check_is_detained_long_time_the_local_wagons()
    {
        $this->artisan('db:seed --class=DetainersTableSeeder');

        $wagon = app(WagonFactory::class)->create();

        $this->assertFalse($wagon->isDetainedLong());

        $wagon->update([
            'detainer_id' => 7,
            'detained_at' => Carbon::parse('-45 hours'),
        ]);

        $this->assertFalse($wagon->fresh()->isDetainedLong());

        $wagon->update([
            'released_at' => Carbon::parse('-40 hours'),
        ]);

        $this->assertTrue($wagon->fresh()->isDetainedLong());

        $wagon->update([
            'departed_at' => Carbon::parse('-16 hours'),
        ]);

        $this->assertFalse($wagon->fresh()->isDetainedLong());

        $wagon->update([
            'departed_at' => Carbon::parse('-5 hours'),
        ]);

        $this->assertTrue($wagon->fresh()->isDetainedLong());
    }
}
